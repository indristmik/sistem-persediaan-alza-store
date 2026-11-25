<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class BarangKeluarController extends BaseController
{
    public function barangkeluar()
    {
        return view('Owner/barang_keluar/index');
    }
}
