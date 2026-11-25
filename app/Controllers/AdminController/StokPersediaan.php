<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\StokPersediaanModel;
use App\Models\KategoriModel;

class StokPersediaan extends BaseController
{
    protected $stokModel;
    protected $kategoriModel;
    protected $db;

    public function __construct()
    {
        $this->stokModel     = new StokPersediaanModel();
        $this->kategoriModel = new KategoriModel();
        $this->db            = \Config\Database::connect();
    }

    public function index()
    {
        // Tangkap parameter filter dari URL (GET)
        $filterKategori = $this->request->getGet('kategori');
        $filterUkuran   = $this->request->getGet('ukuran');
        $filterStatus   = $this->request->getGet('status');

        // Ambil daftar item Menipis & Habis untuk ikon lonceng notifikasi
        $semuaStok      = $this->stokModel->getStokPersediaan();
        $notifikasiStok = array_filter($semuaStok, function ($item) {
            return $item['status_stok'] === 'Menipis' || $item['status_stok'] === 'Habis';
        });

        $data = [
            'title'           => 'Stok Persediaan',
            'ringkasan'       => $this->stokModel->getRingkasanStok(),
            'stok_persediaan' => $this->stokModel->getStokPersediaan($filterKategori, $filterUkuran, $filterStatus),
            'notifikasi_stok' => $notifikasiStok,
            'kategori'        => $this->kategoriModel->findAll(),
            'filter_kategori' => $filterKategori,
            'filter_ukuran'   => $filterUkuran,
            'filter_status'   => $filterStatus,
        ];

        return view('Admin/stok_persediaan/index', $data);
    }

    // Halaman Detail Kartu Stok (Riwayat Pergerakan per SKU)
    public function kartuStok($idVarian = null)
    {
        // Support baik /Admin/StokPersediaan/kartuStok/4 maupun /Admin/PergerakanStok?id_varian=4
        $idVarian = $idVarian ?? $this->request->getGet('id_varian');

        if (empty($idVarian)) {
            return redirect()->to('/Admin/StokPersediaan');
        }

        // 1. Detail Varian (join produk & kategori)
        $varian = $this->db->table('varian_produk vp')
            ->select('vp.*, pr.nama_produk, k.nama_kategori')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = pr.id_kategori', 'left')
            ->where('vp.id_varian', $idVarian)
            ->get()
            ->getRowArray();

        if (!$varian) {
            return redirect()->to('/Admin/StokPersediaan')->with('error', 'Data SKU tidak ditemukan.');
        }

        // Tangkap filter tanggal (opsional)
        $tglMulai   = $this->request->getGet('tgl_mulai');
        $tglSelesai = $this->request->getGet('tgl_selesai');

        // 2. Daftar Riwayat Pergerakan Stok (urut dari terlama ke terbaru)
        $builder = $this->db->table('pergerakan_stok')
            ->where('id_varian', $idVarian)
            ->orderBy('id_pergerakan', 'ASC');

        if (!empty($tglMulai)) {
            $builder->where('DATE(tanggal_pergerakan) >=', $tglMulai);
        }
        if (!empty($tglSelesai)) {
            $builder->where('DATE(tanggal_pergerakan) <=', $tglSelesai);
        }

        $riwayat = $builder->get()->getResultArray();

        // Hitung sisa stok aktual saat ini & status badge
        $sisaStok = (int) ($this->db->table('pergerakan_stok')
            ->selectSum('jumlah')
            ->where('id_varian', $idVarian)
            ->get()
            ->getRow()->jumlah ?? 0);

        $stokMin = (int) $varian['stok_minimum'];
        if ($sisaStok <= 0) {
            $statusStok = 'Habis';
        } elseif ($sisaStok <= $stokMin) {
            $statusStok = 'Menipis';
        } else {
            $statusStok = 'Aman';
        }

        return view('Admin/stok_persediaan/kartu_stok', [
            'title'       => 'Kartu Stok — ' . $varian['kode_sku'],
            'varian'      => $varian,
            'riwayat'     => $riwayat,
            'sisa_stok'   => $sisaStok,
            'status_stok' => $statusStok,
            'tgl_mulai'   => $tglMulai,
            'tgl_selesai' => $tglSelesai,
        ]);
    }

    // Halaman Cetak Kartu Stok (PDF / Print)
    public function cetakKartuStok($idVarian = null)
    {
        $idVarian = $idVarian ?? $this->request->getGet('id_varian');

        if (empty($idVarian)) {
            return redirect()->to('/Admin/StokPersediaan');
        }

        $varian = $this->db->table('varian_produk vp')
            ->select('vp.*, pr.nama_produk, k.nama_kategori')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = pr.id_kategori', 'left')
            ->where('vp.id_varian', $idVarian)
            ->get()
            ->getRowArray();

        if (!$varian) {
            return redirect()->to('/Admin/StokPersediaan')->with('error', 'Data SKU tidak ditemukan.');
        }

        $tglMulai   = $this->request->getGet('tgl_mulai');
        $tglSelesai = $this->request->getGet('tgl_selesai');

        $builder = $this->db->table('pergerakan_stok')
            ->where('id_varian', $idVarian)
            ->orderBy('id_pergerakan', 'ASC');

        if (!empty($tglMulai)) {
            $builder->where('DATE(tanggal_pergerakan) >=', $tglMulai);
        }
        if (!empty($tglSelesai)) {
            $builder->where('DATE(tanggal_pergerakan) <=', $tglSelesai);
        }

        $riwayat = $builder->get()->getResultArray();

        $sisaStok = (int) ($this->db->table('pergerakan_stok')
            ->selectSum('jumlah')
            ->where('id_varian', $idVarian)
            ->get()
            ->getRow()->jumlah ?? 0);

        return view('Admin/stok_persediaan/cetak_kartu_stok', [
            'title'       => 'Cetak Kartu Stok — ' . $varian['kode_sku'],
            'varian'      => $varian,
            'riwayat'     => $riwayat,
            'sisa_stok'   => $sisaStok,
            'tgl_mulai'   => $tglMulai,
            'tgl_selesai' => $tglSelesai,
        ]);
    }
}