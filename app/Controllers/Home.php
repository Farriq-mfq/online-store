<?php

namespace App\Controllers;

class Home extends BaseController
{
    private string $c;
    public function index()
    {
        return view('admin/home_view',add_data("james","/index"));
    }
}
