<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use PhpParser\Node\Stmt\Return_;

class ProductController extends BaseController
{
    public function index()
    {
        return view("admin/product/index",add_data("All Product","product/index"));
    }
    public function create()
    {
        return view("admin/product/add_new",add_data("Add New Product","product/new"));
    }
    public function add()
    {
        alert("hallo test","success");
        return redirect()->back();
    }
}
