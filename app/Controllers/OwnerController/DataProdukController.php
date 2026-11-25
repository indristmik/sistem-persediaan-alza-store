<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class DataProdukController extends BaseController
{
    public function dataproduk()
    {
        return view('Owner/data_produk/index');
    }
}
