<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    // 1. Laporan Barang Masuk & Maklun
    public function getLaporanMasuk($tglMulai, $tglSelesai, $idPenjahit = null)
    {
        $builder = $this->db->table('transaksi_masuk tm')
            ->select('
                tm.nomor_referensi,
                tm.tanggal_masuk,
                tm.status_transaksi,
                p.nama_penjahit,
                pr.nama_produk,
                vp.ukuran,
                vp.warna,
                dtm.jumlah,
                dtm.biaya_produksi,
                (dtm.jumlah * dtm.biaya_produksi) as total_upah
            ')
            ->join('penjahit p', 'p.id_penjahit = tm.id_penjahit', 'left')
            ->join('detail_transaksi_masuk dtm', 'dtm.id_transaksi_masuk = tm.id_transaksi_masuk')
            ->join('varian_produk vp', 'vp.id_varian = dtm.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->where('DATE(tm.tanggal_masuk) >=', $tglMulai)
            ->where('DATE(tm.tanggal_masuk) <=', $tglSelesai)
            ->orderBy('tm.tanggal_masuk', 'ASC');

        if (!empty($idPenjahit)) {
            $builder->where('tm.id_penjahit', $idPenjahit);
        }

        return $builder->get()->getResultArray();
    }

    // 2. Laporan Barang Keluar
    public function getLaporanKeluar($tglMulai, $tglSelesai, $idSaluran = null)
    {
        $builder = $this->db->table('transaksi_keluar tk')
            ->select('
                tk.nomor_pesanan,
                tk.tanggal_keluar,
                tk.no_resi,
                sp.nama_saluran,
                pr.nama_produk,
                vp.ukuran,
                vp.warna,
                dtk.jumlah
            ')
            ->join('saluran_penjualan sp', 'sp.id_saluran = tk.id_saluran', 'left')
            ->join('detail_transaksi_keluar dtk', 'dtk.id_transaksi_keluar = tk.id_transaksi_keluar')
            ->join('varian_produk vp', 'vp.id_varian = dtk.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->where('DATE(tk.tanggal_keluar) >=', $tglMulai)
            ->where('DATE(tk.tanggal_keluar) <=', $tglSelesai)
            ->orderBy('tk.tanggal_keluar', 'ASC');

        if (!empty($idSaluran)) {
            $builder->where('tk.id_saluran', $idSaluran);
        }

        return $builder->get()->getResultArray();
    }

    // 3. Laporan Retur Barang
    public function getLaporanRetur($tglMulai, $tglSelesai, $tindakLanjut = null)
    {
        $builder = $this->db->table('tb_retur_barang rb')
            ->select('
                rb.nomor_retur,
                rb.tanggal_retur,
                rb.jumlah_retur,
                rb.kategori_retur,
                rb.alasan,
                rb.tindak_lanjut,
                sp.nama_saluran,
                pr.nama_produk,
                vp.ukuran,
                vp.warna
            ')
            ->join('saluran_penjualan sp', 'sp.id_saluran = rb.id_saluran', 'left')
            ->join('varian_produk vp', 'vp.id_varian = rb.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->where('DATE(rb.tanggal_retur) >=', $tglMulai)
            ->where('DATE(rb.tanggal_retur) <=', $tglSelesai)
            ->orderBy('rb.tanggal_retur', 'ASC');

        if (!empty($tindakLanjut)) {
            $builder->where('rb.tindak_lanjut', $tindakLanjut);
        }

        return $builder->get()->getResultArray();
    }

    // 4. Laporan Stok Akhir Persediaan
    public function getLaporanStokAkhir($idKategori = null, $statusStok = null)
    {
        $builder = $this->db->table('varian_produk vp')
            ->select('
                vp.kode_sku,
                vp.warna,
                vp.ukuran,
                vp.stok_minimum,
                pr.nama_produk,
                k.nama_kategori,
                COALESCE(SUM(ps.jumlah), 0) as sisa_stok
            ')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = pr.id_kategori')
            ->join('pergerakan_stok ps', 'ps.id_varian = vp.id_varian', 'left')
            ->groupBy('vp.id_varian')
            ->orderBy('k.nama_kategori', 'ASC')
            ->orderBy('pr.nama_produk', 'ASC')
            ->orderBy("FIELD(vp.ukuran, 'S', 'M', 'L', 'XL', 'XXL')", '', false);

        if (!empty($idKategori)) {
            $builder->where('k.id_kategori', $idKategori);
        }

        $hasil = $builder->get()->getResultArray();
        $dataFinal = [];

        foreach ($hasil as $row) {
            $stok = (int) $row['sisa_stok'];
            $min  = (int) $row['stok_minimum'];

            if ($stok <= 0) {
                $row['status_stok'] = 'Habis';
            } elseif ($stok <= $min) {
                $row['status_stok'] = 'Menipis';
            } else {
                $row['status_stok'] = 'Aman';
            }

            if (!empty($statusStok) && $row['status_stok'] !== $statusStok) {
                continue;
            }

            $dataFinal[] = $row;
        }

        return $dataFinal;
    }
}