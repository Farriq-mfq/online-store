<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class OrderController extends BaseController
{
    public function index()
    {
        return view('admin/order/index',add_data("All order",'order/index'));
    }
}
