<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class ManajemenUserController extends BaseController
{
    public function manajemenuser()
    {
        return view('Owner/manajemen_user/index');
    }
}
