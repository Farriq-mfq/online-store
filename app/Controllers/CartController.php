<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ShoppingCart;

class CartController extends BaseController
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
        if ($this->request->isAJAX()) {
            $get_cart = $this->cart->where("user_id", auth_user_id())->with("products")->paginate(4);
            if (count($get_cart)) {
                return '
            <div class=" single-cart-block ">
                ' . $this->__render__cart($get_cart) . '
            </div> 
            <div class=" single-cart-block ">
                <div class="btn-block">
                    <a href="cart.html" class="btn">View Cart <i class="fas fa-chevron-right"></i></a>
                    <a href="checkout.html" class="btn btn--primary">Check Out <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            ';
            } else {
                return '<div class="single-cart-block text-center">
                    Cart Empty
            </div> ';
            }
        }
    }

    public function add_to_cart()
    {
        if ($this->request->isAJAX()) {
            try {
                $validate = $this->validate([
                    'id' => "required",
                ]);
                if ($validate) {
                    $id = htmlentities($this->request->getVar('id'));
                    $qty = $this->request->getVar('qty') ?  htmlentities($this->request->getVar('qty')) : 1;
                    $product = $this->product->find($id);
                    $check_product_exist = $this->cart->where("user_id", auth_user_id())->where("product_id", $id)->first();
                    if ($product->product_discount) {
                        if ($product->product_discount[0]->discount_type === "PERCENTAGE") {
                            $price = get_discount($product->price, $product->product_discount[0]->discount_value);
                        } elseif ($product->product_discount[0]->discount_type === "VALUE") {
                            $price = get_less_price($product->price, $product->product_discount[0]->discount_value);
                        } else {
                            $price = $product->price;
                        }
                    } else {
                        $price = $product->price;
                    }
                    if ($check_product_exist != null) {
                        $total_qty =  $check_product_exist->quantity + $qty;
                        $this->cart->update($check_product_exist->session_cart_id, [
                            'quantity' => $total_qty,
                            'total' => $price * $total_qty,
                        ]);
                    } else {
                        $this->cart->insert([
                            "user_id" => auth_user_id(),
                            'product_id' => $id,
                            'quantity' => $qty,
                            'price' => $price,
                            'total' => $price * $qty,
                            'product_img' => $product->product_images[0]->image,
                        ]);
                    }
                    return $this->response->setStatusCode(200)->setJSON(['success' => true]);
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJSON(['error' => "Internal Server Error", 'details' => $e]);
            }
        }
    }

    protected function __render__cart($items)
    {
        $html = "";
        foreach ($items as $item) {
            $product = $this->product->find($item->product_id);
            $html .= '<div class="cart-product">
            <a href="product-details.html" class="image">
                <img src="' . $item->product_img . '" alt="">
            </a>
            <div class="content">
                <h3 class="title"><a href="product-details.html">' . $item->product->title . '</a></h3>
                <p class="price"><span class="qty">' . $item->quantity . ' ×</span> ' . $this->printPrice($product) . '</p>
                <button class="cross-btn" id="__remove__cart__action" data-id="' . $item->session_cart_id . '"><i class="fas fa-times"></i></button>
            </div>
        </div>';
        }
        return $html;
    }

    protected function printPrice($product)
    {
        $html = '';
        if (count($product->product_discount)) {
            foreach ($product->product_discount as $discount) {
                if ($discount->discount_type === "PERCENTAGE") {
                    return '<span class="price">' . format_rupiah(get_discount($product->price, $discount->discount_value)) . '</span>
                    <del class="price-old">' . format_rupiah($product->price) . '</del>
                    <span class="price-discount">' . $discount->discount_value . '%</span>';
                } elseif ($discount->discount_type === "VALUE") {
                    return '<span class="price">' . format_rupiah(get_less_price($product->price, $discount->discount_value)) . '</span>
                    <del class="price-old">' . format_rupiah($product->price) . '</del>
                    <span class="price-discount">' . thousandsCurrencyFormat($discount->discount_value) . '</span>';
                } else {
                    return '<span class="price">' . format_rupiah($product->price) . '</span>';
                }
            }
        } else {
            $html .= '<span class="price">' . format_rupiah($product->price) . '</span>';
        }

        return $html;
    }

    protected function get_primary_img($product_images)
    {
        $primary = "";
        foreach ($product_images as $image) {
            if ($image->is_primary) {
                $primary .= $image->image;
            }
        }
        return $primary;
    }
    public function show_count_cart()
    {
        if ($this->request->isAJAX()) {
            $res = $this->cart->where("user_id", auth_user_id())->countAllResults();
            return '' . $res . '';
        }
    }
    public function show_total_price_cart()
    {
        if ($this->request->isAJAX()) {
            $total_price = $this->cart->where("user_id", auth_user_id())->select("user_id,session_cart_id,sum(total) as 'total_price'")->groupBy("user_id")->first() != null ? $this->cart->where("user_id", auth_user_id())->select("user_id,session_cart_id,sum(total) as 'total_price'")->groupBy("user_id")->first()->total_price : 0;
            return '<small>' . format_rupiah($total_price) . '</small><i class="fas fa-chevron-down"></i>';
        }
    }
    public function remove_cart()
    {
        if ($this->request->isAJAX()) {
            try {
                $validate = $this->validate([
                    'id' => "required",
                ]);
                if ($validate) {
                    $id = htmlentities($this->request->getVar('id'));
                    $remove = $this->cart->delete($id);
                    if ($remove) {
                        return $this->response->setStatusCode(200)->setJSON(['success' => true]);
                    }
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJSON(['error' => "Internal Server Error", 'details' => $e]);
            }
        }
    }
}
