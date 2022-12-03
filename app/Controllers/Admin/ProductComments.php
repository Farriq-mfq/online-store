<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProductComments extends BaseController
{
    public function index()
    {
        return view("admin/product/images/index",add_data("Comments Product","product/comments"));
    }
}
