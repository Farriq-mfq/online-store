<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/home_view',add_data("james","/index"));
    }
}
