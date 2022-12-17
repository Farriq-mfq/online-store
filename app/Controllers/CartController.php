<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShoppingCart;
use Config\Services;

class CartController extends BaseController
{
    protected ShoppingCart $shopping;
    public function __construct()
    {
        $this->shopping = new ShoppingCart();
    }
    public function index()
    {
        $data['carts'] = $this->shopping->where("user_id",Services::authserviceUser()->getSessionData()['user_id'])->findAll();
        return view("client/shop/cart",add_data("Shopping Cart","Cart",$data));
    }
}
