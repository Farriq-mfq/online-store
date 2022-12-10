<?php

namespace App\Controllers;

use Courier;

class Home extends BaseController
{
    private string $c;
    public function index()
    {
        echo "<pre>";
        print_r($this->shipping->get_cost(1,2,10,Courier::TIKI));
        echo "</pre>";
        return;
        return view('admin/home_view',add_data("james","/index"));
    }
}
