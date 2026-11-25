<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class LaporanPersediaanController extends BaseController
{
    public function laporan_persediaan()
    {
        return view('Owner/laporan_persediaan/index');
    }
}
