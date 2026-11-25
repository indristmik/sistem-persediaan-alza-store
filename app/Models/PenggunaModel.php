<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_pengguna';
    protected $returnType       = 'array';

    protected $allowedFields = [
        'username',
        'password',
        'nama_lengkap',
        'peran',
        'waktu_dibuat'
    ];

    protected $useTimestamps = false;
}
