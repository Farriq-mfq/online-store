<?php

namespace App\Controllers;

use App\Models\Categories;
use BANK;
use Config\Services;

class Home extends BaseController
{
    public function index()
    {
        return view('client/home_view',add_data("james","/index"));
    }
    
}

