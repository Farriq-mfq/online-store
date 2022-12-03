<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProductImages extends BaseController
{
    public function index()
    {
        return view("admin/product/images/index",add_data("Images Product","product/images"));
    }
}
