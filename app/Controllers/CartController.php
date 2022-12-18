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
    public function update_cart()
    {
        if($this->request->isAJAX()){
            $user_id = Services::authserviceUser()->getSessionData()['user_id'];
            foreach ($this->request->getVar('input') as $input) {
                $get_cart = $this->shopping->find($input['session_cart_id']);
                $data = [
                    'quantity'=>$input['qty'],
                    "total"=>$input['qty'] *  $get_cart->price
                ];

                $this->shopping->where("user_id",$user_id)->update($input['session_cart_id'],$data);
            }
            echo json_encode(["success"=>"Success update cart"]);
        }
    }
}
