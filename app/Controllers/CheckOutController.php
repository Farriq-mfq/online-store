<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use App\Models\UserAddress;

class CheckOutController extends BaseController
{
    private UserAddress $address;
    private ShoppingCart $cart;
    private Order $order;
    private OrderItem $order_item;
    public function __construct()
    {
        $this->address = new UserAddress();
        $this->cart = new ShoppingCart();
        $this->order = new Order();
        $this->order_item = new OrderItem();
    }
    public function index()
    {
        try {
            $data['addresses'] = $this->address->where("user_id", auth_user_id())->with('users')->findAll();
            $data['carts'] = $this->cart->where("user_id", auth_user_id())->with("products")->findAll();
            $data['total_cart'] = $this->cart->getTotalCart();
            $data['total_weight'] = $this->cart->getWeightProduct() != null ? $this->cart->getWeightProduct()->total_weight : 0;
            return view('client/checkout/index', add_data('checkout', "checkout/index", $data));
        } catch (\Exception $e) {
            session()->setFlashdata("alert_error", "Something went wrong");
            return redirect()->back();
        }
    }
    public function change_address($id)
    {
        try {
            if ($this->address->updatePrimary($id)) {
                $this->address->update($id, ["primary" => true]);
                session()->setFlashdata("alert_success", "Success Update Address");
            } else {
                session()->setFlashdata("alert_error", "Failed Update Address");
            }
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }
    public function complete()
    {
        try {
            if ($this->request->getVar('token')) {
                $token = htmlentities($this->request->getVar('token'));
                $order = $this->order->where('token', "$token")->where('user_id', auth_user_id())->first();
                $data['order'] = $order;
                $data['order_items'] = $this->order_item->where('order_id', $order->order_id)->findAll();
                $data['payment'] = $this->payment->get_status($order->midtrans_id);
                if (!isset($data['payment']->va_numbers)) {
                    $data['emoney'] = $this->order->getSessionEmoney($order->token);
                }
                return view('client/checkout/complete', add_data('Checkout Complete', "checkout/complete", $data));
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
