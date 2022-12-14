<?php

namespace App\Controllers;

use App\Models\Categories;
use BANK;

class Home extends BaseController
{
    public function index()
    {
        $ct = new Categories();
        $data['categories'] = $ct->getCategoriesByParentId();
        $data['print_categories'] = $ct->getCategoriesByParentId();
        return view('client/shop/index',add_data("james","/index",$data));
    }
    
}

