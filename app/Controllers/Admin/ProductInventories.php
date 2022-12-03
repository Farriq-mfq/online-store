<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProductInventories extends BaseController
{
    public function index()
    {
        return view("admin/product/inventories/index",add_data("Inventories Product","product/inventories"));
    }
}
