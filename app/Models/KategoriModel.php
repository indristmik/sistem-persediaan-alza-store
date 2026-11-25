<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kode_produk', 'nama_kategori', 'deskripsi'];

    // Ambil semua kategori sekaligus hitung jumlah produk di dalamnya
    public function getKategoriLengkap()
    {
        return $this->db->table('kategori_produk k')
            ->select('k.*, COUNT(p.id_produk) as jumlah_produk')
            ->join('tb_produk p', 'p.id_kategori = k.id_kategori', 'left')
            ->groupBy('k.id_kategori')
            ->orderBy('k.kode_produk', 'ASC')
            ->get()
            ->getResultArray();
    }

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';
}