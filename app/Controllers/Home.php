<?php

namespace App\Controllers;

use BANK;

class Home extends BaseController
{
    public function index()
    {
        return $this->payment->bank_transfer(BANK::BCA,[]);
        return view('client/home_view',add_data("james","/index"));
    }
}
