<?php

namespace App\Models;

use CodeIgniter\Model;

class SaluranPenjualanModel extends Model
{
    protected $table            = 'saluran_penjualan';
    protected $primaryKey       = 'id_saluran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_saluran', 'status'];

    // Tabel saluran_penjualan tidak menggunakan kolom timestamp
    protected $useTimestamps    = false;
    public function getSaluranLengkap()
    {
        return $this->db->table('saluran_penjualan s')
            ->select('s.*, COUNT(tk.id_transaksi_keluar) as total_transaksi')
            ->join('transaksi_keluar tk', 'tk.id_saluran = s.id_saluran', 'left')
            ->groupBy('s.id_saluran')
            ->orderBy('s.nama_saluran', 'ASC')
            ->get()
            ->getResultArray();
    }
}