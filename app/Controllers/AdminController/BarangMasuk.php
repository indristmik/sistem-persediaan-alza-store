<?php

namespace App\Controllers\AdminController;

use App\Controllers\BaseController;
use App\Models\BarangMasukModel;

class BarangMasuk extends BaseController
{
    protected $barangMasukModel;
    protected $db;

    public function __construct()
    {
        $this->barangMasukModel = new BarangMasukModel();
        $this->db               = \Config\Database::connect();
    }

    public function index()
    {
        $penjahit = $this->db->table('penjahit')
            ->where('status_aktif', 'Aktif')
            ->orderBy('nama_penjahit', 'ASC')
            ->get()
            ->getResultArray();

        $varian = $this->db->table('varian_produk vp')
            ->select('vp.id_varian, vp.kode_sku, vp.warna, vp.ukuran, pr.nama_produk')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('pr.nama_produk', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title'        => 'Barang Masuk',
            'barang_masuk' => $this->barangMasukModel->getBarangMasukLengkap(),
            'penjahit'     => $penjahit,
            'varian'       => $varian
        ];

        return view('Admin/barang_masuk/index', $data);
    }

    public function simpan()
    {
        $idVarians      = $this->request->getPost('id_varian');
        $jumlahs        = $this->request->getPost('jumlah');
        $biayaProduksis = $this->request->getPost('biaya_produksi');

        if (empty($idVarians) || !is_array($idVarians)) {
            return redirect()->to('/Admin/BarangMasuk')
                ->with('error', 'Gagal! Minimal harus ada 1 item barang yang diinput.');
        }

        // Validasi semua baris sebelum menyimpan ke database
        foreach ($idVarians as $i => $idVarian) {
            $qty   = (int) ($jumlahs[$i] ?? 0);
            $tarif = (float) ($biayaProduksis[$i] ?? -1);

            if (empty($idVarian)) {
                return redirect()->to('/Admin/BarangMasuk')
                    ->with('error', 'Gagal! Pastikan semua baris Produk & Ukuran sudah dipilih.');
            }
            if ($qty <= 0) {
                return redirect()->to('/Admin/BarangMasuk')
                    ->with('error', 'Gagal! Jumlah barang masuk pada setiap baris harus lebih dari 0 pcs.');
            }
            if ($tarif < 0) {
                return redirect()->to('/Admin/BarangMasuk')
                    ->with('error', 'Gagal! Tarif maklun tidak boleh bernilai negatif.');
            }
        }

        $tanggalMasuk  = $this->request->getPost('tanggal_masuk') . ' ' . date('H:i:s');
        $idPengguna    = session()->get('id_pengguna') ?? 1;
        $kodeTransaksi = $this->barangMasukModel->generateKodeTransaksi();

        $this->db->transStart();

        // 1. Simpan 1 header di tabel transaksi_masuk
        $this->barangMasukModel->insert([
            'nomor_referensi'  => $kodeTransaksi,
            'tanggal_masuk'    => $tanggalMasuk,
            'id_penjahit'      => $this->request->getPost('id_penjahit'),
            'status_transaksi' => 'Selesai',
            'keterangan'       => $this->request->getPost('keterangan'),
            'id_pengguna'      => $idPengguna
        ]);
        $idTransaksiMasuk = $this->barangMasukModel->getInsertID();

        // 2. Loop setiap baris barang -> simpan ke detail_transaksi_masuk & pergerakan_stok
        foreach ($idVarians as $i => $idVarian) {
            $qty   = (int) $jumlahs[$i];
            $tarif = (float) $biayaProduksis[$i];

            $this->db->table('detail_transaksi_masuk')->insert([
                'id_transaksi_masuk' => $idTransaksiMasuk,
                'id_varian'          => $idVarian,
                'jumlah'             => $qty,
                'biaya_produksi'     => $tarif
            ]);

            $stokLama = $this->db->table('pergerakan_stok')
                ->selectSum('jumlah')
                ->where('id_varian', $idVarian)
                ->get()
                ->getRow()->jumlah ?? 0;

            $this->db->table('pergerakan_stok')->insert([
                'id_varian'          => $idVarian,
                'tipe_pergerakan'    => 'MASUK',
                'id_transaksi_masuk' => $idTransaksiMasuk,
                'jumlah'             => $qty,
                'saldo_stok'         => $stokLama + $qty,
                'keterangan'         => 'Setoran penjahit (' . $kodeTransaksi . ')',
                'tanggal_pergerakan' => $tanggalMasuk,
                'id_pengguna'        => $idPengguna
            ]);
        }

        $this->db->transComplete();

        return redirect()->to('/Admin/BarangMasuk')
            ->with('pesan', 'Transaksi barang masuk ' . $kodeTransaksi . ' (' . count($idVarians) . ' item) berhasil dicatat.');
    }

    // Halaman Cetak Resi / Nota Pembayaran Penjahit (Multi-Item)
    public function nota($id)
    {
        $header = $this->db->table('transaksi_masuk tm')
            ->select('tm.*, pj.nama_penjahit, pj.no_telepon, pj.alamat')
            ->join('penjahit pj', 'pj.id_penjahit = tm.id_penjahit', 'left')
            ->where('tm.id_transaksi_masuk', $id)
            ->get()
            ->getRowArray();

        if (!$header) {
            return redirect()->to('/Admin/BarangMasuk')->with('error', 'Data nota tidak ditemukan.');
        }

        $items = $this->db->table('detail_transaksi_masuk dtm')
            ->select('
                dtm.jumlah,
                dtm.biaya_produksi,
                (dtm.jumlah * dtm.biaya_produksi) as total_biaya,
                vp.kode_sku,
                vp.ukuran,
                vp.warna,
                pr.nama_produk
            ')
            ->join('varian_produk vp', 'vp.id_varian = dtm.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->where('dtm.id_transaksi_masuk', $id)
            ->get()
            ->getResultArray();

        return view('Admin/barang_masuk/nota', [
            'header' => $header,
            'items'  => $items
        ]);
    }

    // Hapus per 1 item barang saja (header baru ikut dihapus jika semua item di nota sudah habis)
    public function hapus($idDetail)
    {
        $detail = $this->db->table('detail_transaksi_masuk')
            ->where('id_detail_masuk', $idDetail)
            ->get()
            ->getRowArray();

        if (!$detail) {
            return redirect()->to('/Admin/BarangMasuk')->with('error', 'Data item tidak ditemukan.');
        }

        $idTransaksi = $detail['id_transaksi_masuk'];
        $idVarian    = $detail['id_varian'];

        $this->db->transStart();

        // 1. Hapus mutasi stok khusus untuk varian & transaksi ini saja
        $this->db->table('pergerakan_stok')
            ->where('id_transaksi_masuk', $idTransaksi)
            ->where('id_varian', $idVarian)
            ->limit(1)
            ->delete();

        // 2. Hapus 1 baris rincian barang ini saja
        $this->db->table('detail_transaksi_masuk')
            ->where('id_detail_masuk', $idDetail)
            ->delete();

        // 3. Cek sisa item di nota ini; kalau sudah 0, baru hapus header transaksi_masuk
        $sisaItem = $this->db->table('detail_transaksi_masuk')
            ->where('id_transaksi_masuk', $idTransaksi)
            ->countAllResults();

        if ($sisaItem == 0) {
            $this->barangMasukModel->delete($idTransaksi);
        }

        $this->db->transComplete();

        return redirect()->to('/Admin/BarangMasuk')
            ->with('pesan', '1 item barang masuk berhasil dihapus dan stok telah dikoreksi.');
    }
}