<?php

namespace App\Controllers;

use App\Models\Categories;

class Home extends BaseController
{
    public function index()
    {
        $ct = new Categories();
        echo "<pre>";
        print_r($ct->getCategoriesByParentId(null));
        echo "</pre>";
        return;
        return view('admin/home_view',add_data("james","/index"));
    }
    
}

