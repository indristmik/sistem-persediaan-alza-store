<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class BarangMasukController extends BaseController
{
    public function barangmasuk()
    {
        return view('Owner/barang_masuk/index');
    }
}
