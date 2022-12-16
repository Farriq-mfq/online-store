<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories;

class HomeController extends BaseController
{
    public function index()
    {
        $ct = new Categories();
        $data['categories'] = $ct->getCategoriesByParentId();
        $data['print_categories'] = $ct->getCategoriesByParentId();
        return view('admin/home_view',add_data("james","/index",$data));
    }
}
