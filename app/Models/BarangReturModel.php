<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangReturModel extends Model
{
    protected $table            = 'tb_retur_barang';
    protected $primaryKey       = 'id_retur';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nomor_retur',
        'id_saluran',
        'id_transaksi_keluar',
        'id_varian',
        'jumlah_retur',
        'kategori_retur',
        'tindak_lanjut',
        'alasan',
        'tanggal_retur',
        'id_pengguna'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';

    // Mengambil daftar barang retur lengkap dengan asal saluran, resi referensi, produk, dan ukuran
    public function getBarangReturLengkap()
    {
        return $this->db->table('tb_retur_barang rb')
            ->select('
                rb.*,
                sp.nama_saluran,
                tk.nomor_pesanan,
                tk.no_resi,
                pr.nama_produk,
                vp.ukuran,
                vp.warna
            ')
            ->join('saluran_penjualan sp', 'sp.id_saluran = rb.id_saluran', 'left')
            ->join('transaksi_keluar tk', 'tk.id_transaksi_keluar = rb.id_transaksi_keluar', 'left')
            ->join('varian_produk vp', 'vp.id_varian = rb.id_varian')
            ->join('tb_produk pr', 'pr.id_produk = vp.id_produk')
            ->orderBy('rb.tanggal_retur', 'DESC')
            ->orderBy('rb.id_retur', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Auto-generate Kode Transaksi Retur (Contoh: RT-20261121-001)
    public function generateKodeRetur()
    {
        $tanggal = date('Ymd');
        $prefix  = 'RT-' . $tanggal . '-';

        $last = $this->like('nomor_retur', $prefix, 'after')
            ->orderBy('id_retur', 'DESC')
            ->first();

        $urutan = 1;
        if ($last) {
            $lastNumber = (int) substr($last['nomor_retur'], -3);
            $urutan = $lastNumber + 1;
        }

        return $prefix . str_pad($urutan, 3, '0', STR_PAD_LEFT);
    }
}