<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table            = 'transaksi_masuk';
    protected $primaryKey       = 'id_transaksi_masuk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nomor_referensi',
        'tanggal_masuk',
        'id_penjahit',
        'status_transaksi',
        'keterangan',
        'id_pengguna'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';

    // Mengambil daftar barang masuk lengkap dengan penjahit, produk, ukuran, jumlah & biaya
    public function getBarangMasukLengkap()
    {
        return $this->db->table('transaksi_masuk tm')
            ->select('
                dtm.id_detail_masuk,
                tm.id_transaksi_masuk,
                tm.nomor_referensi,
                tm.tanggal_masuk,
                tm.keterangan,
                p.nama_penjahit,
                pr.nama_produk,
                vp.ukuran,
                vp.warna,
                dtm.jumlah,
                dtm.biaya_produksi,
                (dtm.jumlah * dtm.biaya_produksi) as total_biaya
            ')
            ->join('penjahit p', 'p.id_penjahit = tm.id_penjahit', 'left')
            ->join('detail_transaksi_masuk dtm', 'dtm.id_transaksi_masuk = tm.id_transaksi_masuk')
            ->join('varian_produk vp', 'vp.id_varian = dtm.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('tm.tanggal_masuk', 'DESC')
            ->orderBy('tm.id_transaksi_masuk', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Auto-generate Kode Transaksi (Contoh: BM-20261119-001)
    public function generateKodeTransaksi()
    {
        $tanggal = date('Ymd');
        $prefix  = 'BM-' . $tanggal . '-';

        $last = $this->selectMax('nomor_referensi')
            ->like('nomor_referensi', $prefix, 'after')
            ->first();

        $urutan = 1;
        if (!empty($last['nomor_referensi'])) {
            $lastNumber = (int) substr($last['nomor_referensi'], -3);
            $urutan = $lastNumber + 1;
        }

        return $prefix . str_pad($urutan, 3, '0', STR_PAD_LEFT);
    }
}