<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShoppingCart;
use App\Models\UserAddress;

class CheckOutController extends BaseController
{
    private UserAddress $address;
    private ShoppingCart $cart;
    public function __construct()
    {
        $this->address = new UserAddress();
        $this->cart = new ShoppingCart();
    }
    public function index()
    {
        $data['addresses'] = $this->address->where("user_id",auth_user_id())->with('users')->findAll();
        $data['carts'] = $this->cart->where("user_id",auth_user_id())->with("products")->findAll();
        $data['total_cart'] = $this->cart->getTotalCart();
        $data['total_weight'] = $this->cart->getWeightProduct()!=null ? $this->cart->getWeightProduct()->total_weight : 0;
        return view('client/checkout/index',add_data('checkout',"checkout/index",$data));
    }
}
