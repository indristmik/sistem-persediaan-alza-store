<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\BarangKeluarModel;

class BarangKeluar extends BaseController
{
    protected $barangKeluarModel;
    protected $db;

    public function __construct()
    {
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->db                = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil daftar saluran penjualan yang aktif untuk dropdown
        $saluran = $this->db->table('saluran_penjualan')
            ->where('status', 'Aktif')
            ->get()
            ->getResultArray();

        // Ambil daftar produk & varian beserta sisa stoknya untuk dropdown
        $varian = $this->db->table('varian_produk vp')
            ->select('vp.id_varian, vp.kode_sku, vp.warna, vp.ukuran, pr.nama_produk, COALESCE(SUM(ps.jumlah), 0) as stok')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('pergerakan_stok ps', 'ps.id_varian = vp.id_varian', 'left')
            ->groupBy('vp.id_varian')
            ->orderBy('pr.nama_produk', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title'         => 'Barang Keluar',
            'barang_keluar' => $this->barangKeluarModel->getBarangKeluarLengkap(),
            'saluran'       => $saluran,
            'varian'        => $varian
        ];

        return view('Admin/barang_keluar/index', $data);
    }

    public function simpan()
    {
        $idVarian      = $this->request->getPost('id_varian');
        $jumlah        = (int) $this->request->getPost('jumlah');
        $tanggalKeluar = $this->request->getPost('tanggal_keluar') . ' ' . date('H:i:s');
        $idPengguna    = session()->get('id_pengguna') ?? 1;

        // 1. Validasi jumlah harus lebih dari 0
        if ($jumlah <= 0) {
            return redirect()->to('/Admin/BarangKeluar')
                ->with('error', 'Gagal! Jumlah barang keluar harus lebih dari 0 pcs.');
        }

        // 2. Cek sisa stok saat ini sebelum memproses barang keluar
        $stokSaatIni = (int) ($this->db->table('pergerakan_stok')
            ->selectSum('jumlah')
            ->where('id_varian', $idVarian)
            ->get()
            ->getRow()->jumlah ?? 0);

        if ($jumlah > $stokSaatIni) {
            return redirect()->to('/Admin/BarangKeluar')
                ->with('error', 'Stok tidak mencukupi! Sisa stok tersedia: ' . $stokSaatIni . ' pcs.');
        }

        // Ambil harga jual otomatis dari master varian_produk
        $dataVarian    = $this->db->table('varian_produk')->where('id_varian', $idVarian)->get()->getRowArray();
        $hargaJual     = $dataVarian['harga_jual'] ?? 0;
        $kodeTransaksi = $this->barangKeluarModel->generateKodeTransaksi();

        $this->db->transStart();

        // Simpan header ke tabel transaksi_keluar
        $this->barangKeluarModel->insert([
            'id_saluran'       => $this->request->getPost('id_saluran'),
            'nomor_pesanan'    => $kodeTransaksi,
            'no_resi'          => trim((string) $this->request->getPost('no_resi')) ?: '-',
            'tanggal_keluar'   => $tanggalKeluar,
            'status_transaksi' => 'Selesai',
            'keterangan'       => $this->request->getPost('keterangan'),
            'id_pengguna'      => $idPengguna
        ]);
        $idTransaksiKeluar = $this->barangKeluarModel->getInsertID();

        // Simpan rincian ke tabel detail_transaksi_keluar
        $this->db->table('detail_transaksi_keluar')->insert([
            'id_transaksi_keluar' => $idTransaksiKeluar,
            'id_varian'           => $idVarian,
            'jumlah'              => $jumlah,
            'harga_jual'          => $hargaJual
        ]);

        // Catat pengurangan stok ke pergerakan_stok (jumlah dibuat negatif)
        $this->db->table('pergerakan_stok')->insert([
            'id_varian'           => $idVarian,
            'tipe_pergerakan'     => 'KELUAR',
            'id_transaksi_keluar' => $idTransaksiKeluar,
            'jumlah'              => -$jumlah,
            'saldo_stok'          => $stokSaatIni - $jumlah,
            'keterangan'          => 'Barang keluar (' . $kodeTransaksi . ')',
            'tanggal_pergerakan'  => $tanggalKeluar,
            'id_pengguna'         => $idPengguna
        ]);

        $this->db->transComplete();

        return redirect()->to('/Admin/BarangKeluar')
            ->with('pesan', 'Transaksi barang keluar ' . $kodeTransaksi . ' berhasil dicatat.');
    }

    public function hapus($id)
    {
        $this->db->transStart();
        $this->db->table('pergerakan_stok')->where('id_transaksi_keluar', $id)->delete();
        $this->db->table('detail_transaksi_keluar')->where('id_transaksi_keluar', $id)->delete();
        $this->barangKeluarModel->delete($id);
        $this->db->transComplete();

        return redirect()->to('/Admin/BarangKeluar')
            ->with('pesan', 'Transaksi barang keluar berhasil dihapus dan stok otomatis dikembalikan.');
    }
}