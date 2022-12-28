<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ShoppingCart;

class WebCartController extends BaseController
{
    private ShoppingCart $cart;
    private Product $product;
    public function __construct()
    {
        $this->cart = new ShoppingCart();
        $this->product = new Product();
    }
    public function index()
    {
        try {
            $data['carts'] = $this->cart->where('user_id', auth_user_id())->with('products')->findAll();
            $data['total_cart'] = $this->cart->getTotalCart();
            $data['interested'] = $this->product->getProductintersed();
            return view("client/cart/index", add_data("Shopping Cart", "cart/index", $data));
        } catch (\Exception $e) {
            session()->setFlashdata("alert_error", "Something went wrong");
            return redirect()->back();
        }
    }

    public function updateCart()
    {
        try {

            $cart_id = $this->request->getVar("cart_id");
            $qty = $this->request->getVar("qty");
            foreach ($cart_id as $key => $id) {
                if (!empty($id) && !empty($qty[$key])) {
                    if (is_numeric($id) && is_numeric($qty[$key])) {
                        $cart = $this->cart->where('user_id', auth_user_id())->find($id);
                        if ($cart != null) {
                            $total = $cart->price * $qty[$key];
                            $this->cart->where("user_id", auth_user_id())->update($id, ['quantity' => $qty[$key], 'total' => $total]);
                        }
                        session()->setFlashdata("alert_success", "Success Update cart");
                    } else {
                        session()->setFlashdata("alert_error", "Failed Update Cart");
                    }
                } else {
                    session()->setFlashdata("alert_error", "Failed Update Cart");
                }
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function removeCart($id)
    {
        if ($this->request->isAJAX()) {
            try {
                $delete = $this->cart->delete($id);
                if ($delete) {
                    return $this->response->setStatusCode(200)->setJSON(['success' => true]);
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJSON(['error' => "Intetval server error"]);
            }
        }
    }

    public function order()
    {
        dd($this->request->getVar());
    }
}
