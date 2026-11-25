<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class StokMenipisController extends BaseController
{
    public function stokmenipis()
    {
        return view('Owner/stok_menipis/index');
    }
}
