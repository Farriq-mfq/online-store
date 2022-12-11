<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo "<pre>";
            // print_r($this->payment->e_money("qris",["transaction_details"=>["gross_amount"=>100,"order_id"=>time()]]));
            print_r($this->payment->e_money("qris",["transaction_details"=>["gross_amount"=>100,"order_id"=>time()]],1));
        echo "</pre>";
        return;
        return view('admin/home_view',add_data("james","/index"));
    }
}
