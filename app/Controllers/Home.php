<?php

namespace App\Controllers;

<<<<<<< HEAD
use App\Models\Categories;
=======
use BANK;
>>>>>>> 820ba36039bab7c32ef344144fa55443c0e9a4a0

class Home extends BaseController
{
    public function index()
    {
<<<<<<< HEAD
        $ct = new Categories();
        echo "<pre>";
        print_r($ct->getCategoriesByParentId(null));
        echo "</pre>";
        return;
        return view('admin/home_view',add_data("james","/index"));
=======
        return $this->payment->bank_transfer(BANK::BCA,[]);
        return view('client/home_view',add_data("james","/index"));
>>>>>>> 820ba36039bab7c32ef344144fa55443c0e9a4a0
    }
    
}

