<?php

namespace App\Controllers;

use App\Models\Categories;
use BANK;
use Config\Services;

class Home extends BaseController
{
    public function index()
    {
        Services::authserviceAdmin()->attempt(["email"=>"admin@gmail.com","password"=>"admin"]);
        $ct = new Categories();
        $data['categories'] = $ct->getCategoriesByParentId();
        $data['print_categories'] = $ct->getCategoriesByParentId();
        return view('admin/home_view',add_data("james","/index",$data));
    }
    
}

