<?php

namespace App\Controllers\OwnerController;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function dashboard()
    {
        return view('Owner/Dashboard');
    }
}
