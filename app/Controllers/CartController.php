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
                session()->setFlashdata("alert_cart","Success Update Cart");
            }
        }
    }
    public function remove_cart($id)
    {
        $this->shopping->delete($id);
        session()->setFlashdata("alert_cart","Success Delete Item");
        return redirect()->to(base_url("/cart"));
    }
    public function remove_cart_all()
    {
        if($this->request->isAJAX()){
            $data = [];
            foreach ($this->request->getVar('input') as $input ) {
                $data []= $input["session_cart_id"];
            }
            $this->shopping->whereIn("session_cart_id",$data)->delete();
            session()->setFlashdata("alert_cart","Success Delete Items");
        }
    }
}
