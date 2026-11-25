<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjahitModel extends Model
{
    protected $table            = 'penjahit';
    protected $primaryKey       = 'id_penjahit';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_penjahit',
        'no_telepon',
        'alamat',
        'status_aktif',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';

    // Khusus untuk dropdown Barang Masuk (hanya yang Aktif)
    public function getPenjahitAktif()
    {
        return $this->where('status_aktif', 'Aktif')
            ->orderBy('nama_penjahit', 'ASC')
            ->findAll();
    }
}