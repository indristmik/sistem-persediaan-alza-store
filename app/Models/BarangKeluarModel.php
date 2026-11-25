<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table            = 'transaksi_keluar';
    protected $primaryKey       = 'id_transaksi_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_saluran',
        'nomor_pesanan',
        'no_resi',
        'tanggal_keluar',
        'tujuan_pengiriman',
        'status_transaksi',
        'keterangan',
        'id_pengguna'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';

    // Mengambil daftar barang keluar lengkap dengan saluran, produk, ukuran, jumlah & resi
    public function getBarangKeluarLengkap()
    {
        return $this->db->table('transaksi_keluar tk')
            ->select('
                tk.id_transaksi_keluar,
                tk.nomor_pesanan,
                tk.no_resi,
                tk.tanggal_keluar,
                tk.keterangan,
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
            ->orderBy('tk.tanggal_keluar', 'DESC')
            ->orderBy('tk.id_transaksi_keluar', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Auto-generate Kode Transaksi (Contoh: BK-20261119-001)
    public function generateKodeTransaksi()
    {
        $tanggal = date('Ymd');
        $prefix  = 'BK-' . $tanggal . '-';

        $last = $this->like('nomor_pesanan', $prefix, 'after')
            ->orderBy('id_transaksi_keluar', 'DESC')
            ->first();

        $urutan = 1;
        if ($last) {
            $lastNumber = (int) substr($last['nomor_pesanan'], -3);
            $urutan = $lastNumber + 1;
        }

        return $prefix . str_pad($urutan, 3, '0', STR_PAD_LEFT);
    }
}