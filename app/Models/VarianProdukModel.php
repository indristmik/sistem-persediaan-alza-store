<?php

namespace App\Models;

use CodeIgniter\Model;

class VarianProdukModel extends Model
{
    protected $table            = 'varian_produk';
    protected $primaryKey       = 'id_varian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'id_produk',
        'kode_sku',
        'warna',
        'ukuran',
        'harga_jual',
        'stok_minimum'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'waktu_dibuat';
    protected $updatedField  = '';
}
