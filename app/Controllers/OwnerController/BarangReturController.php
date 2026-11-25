<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class BarangReturController extends BaseController
{
    public function barang_retur()
    {
        return view('Owner/barang_retur/index');
    }
}
