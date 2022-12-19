<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShoppingCart;
use CodeIgniter\Encryption\Encryption;
use Config\Services;

class CartController extends BaseController
{
    protected ShoppingCart $shopping;
    protected $encrypter;
    protected $config;
    public function __construct()
    {
        $this->shopping = new ShoppingCart();
        $this->encrypter = Services::encrypter();
    }
    public function index()
    {
        $data['carts'] = $this->shopping->where("user_id", Services::authserviceUser()->getSessionData()['user_id'])->findAll();
        return view("client/shop/cart", add_data("Shopping Cart", "Cart", $data));
    }
    public function update_cart()
    {
        if ($this->request->isAJAX()) {
            $user_id = Services::authserviceUser()->getSessionData()['user_id'];
            foreach ($this->request->getVar('input') as $input) {
                $get_cart = $this->shopping->find($input['session_cart_id']);
                $data = [
                    'quantity' => $input['qty'],
                    "total" => $input['qty'] *  $get_cart->price
                ];

                $this->shopping->where("user_id", $user_id)->update($input['session_cart_id'], $data);
                session()->setFlashdata("alert_cart", "Success Update Cart");
            }
        }
    }
    public function remove_cart($id)
    {
        $this->shopping->delete($id);
        session()->setFlashdata("alert_cart", "Success Delete Item");
        return redirect()->to(base_url("/cart"));
    }
    public function remove_cart_all()
    {
        if ($this->request->isAJAX()) {
            $data = [];
            foreach ($this->request->getVar('input') as $input) {
                $data[] = $input["session_cart_id"];
            }
            $this->shopping->whereIn("session_cart_id", $data)->delete();
            session()->setFlashdata("alert_cart", "Success Delete Items");
        }
    }
    public function checkout()
    {
        if ($this->request->getVar("check_shopping_cart")) {
            $enc = base64_encode(bin2hex($this->encrypter->encrypt(http_build_query(["items" => $this->request->getVar("check_shopping_cart"), "expired" => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . "+ 2 hours"),)]))));
            return redirect()->to(base_url("/cart/checkout?checkout_session=" . $enc . ""));
        } else {
            session()->setFlashdata("alert_cart", "Please Selected Items to Proceed checkout");
            return redirect()->to(base_url("/cart"));
        }
    }
    public function checkout_page()
    {
        if ($this->request->getVar("checkout_session")) {
            $checkout = htmlentities($this->request->getVar("checkout_session"));
            try {
                $dec = $this->encrypter->decrypt(hex2bin(base64_decode($checkout)));
                parse_str($dec, $data);
                if ($data['expired'] <= date("Y-m-d H:i:s")) {
                    session()->setFlashdata("alert_cart", "Time Checkout expired");
                    return redirect()->to(base_url("/cart"));
                }
                return view("client/shop/check_out", add_data("CHECKOUT", "cart/checkout"));
            } catch (\Exception $e) {
                return redirect()->to(base_url("/cart"));
            }
        } else {
            return redirect()->to(base_url("/cart"));
        }
    }
}
