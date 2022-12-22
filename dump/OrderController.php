<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\UserAddress;
use BANK;
use Config\Services;
use EMONEY;

class OrderController extends BaseController
{
    protected UserAddress $useraddress;
    protected $encrypter;
    protected ShoppingCart $shopping;
    protected Order $order;

    public function __construct()
    {
        $this->useraddress = new UserAddress();
        $this->encrypter = Services::encrypter();
        $this->shopping = new ShoppingCart();
        $this->order = new Order();
    }
    public function index()
    {
        //
    }

    public function checkout()
    {
        // check user exist address 
        $check_user_address = count($this->useraddress->findAll(auth_user_id()));
        if ($check_user_address) {
            $dec = $this->encrypter->decrypt(hex2bin(base64_decode($this->request->getVar("items"))));
            parse_str($dec, $output);
        } else {
            $dec = $this->encrypter->decrypt(hex2bin(base64_decode($this->request->getVar("items"))));
            parse_str($dec, $output);
            // insert user address 
            $validate = $this->validate([
                "firstname" => "required|max_length[150]",
                "lastname" => "required|max_length[150]",
                "phone" => "required|max_length[14]",
                "address1" => "required",
                "province" => "required|numeric",
                "city" => "required",
                "postcode_zip" => "required",
                "shipping" => "required",
                "shipping_service" => "required",
                "payment_option" => "required",
                "option_payment" => "required",
                "items" => "required"
            ]);

            if (!$validate) {
                session()->setFlashdata("validation", $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            $data_address = [
                "firstname" => $this->request->getVar("firstname"),
                "lastname" => $this->request->getVar("lastname"),
                "phone" => $this->request->getVar("phone"),
                "address1" => $this->request->getVar("address1"),
                "address2" => $this->request->getVar("address2"),
                "province" => $this->request->getVar("province"),
                "city" => $this->request->getVar("city"),
                "postcode_zip" => $this->request->getVar("postcode_zip"),
                "address_notes" => $this->request->getVar("address_notes"),
                "user_id" => auth_user_id()
            ];
            $addresss_id = $this->useraddress->insert($data_address);
            $items =  $this->shopping->whereIn("session_cart_id", $output['items'])->with("products")->findAll();
            $total_weight = $this->getTotalWeight($items);
            $subtotal = $this->getSubtotal($items);
            $shipping_details = $this->shipping->get_cost($this->request->getVar("city"), $total_weight, $this->request->getVar("shipping"));
            $shipping_cost = $this->getservicecost($shipping_details, $this->request->getVar("shipping_service"));

            $data_order = [
                "items" => $this->request->getVar("items"),
                "shipping_provider" => $this->request->getVar("shipping"),
                "shipping_service" => $this->request->getVar("shipping_service"),
                "origin" => $shipping_details->origin_details->city_id,
                "destination_origin" => $shipping_details->destination_details->city_id,
                "notes" => $this->request->getVar("notes"),
                "subtotal" => $subtotal + $shipping_cost,
                "payment_option" => $this->request->getVar("payment_option"),
                "option_payment" => $this->request->getVar("option_payment"),
                "user_address_id" => $addresss_id
            ];

            $this->do_order($data_order);

            dd($this->request->getVar());
        }
    }
    public function getSubtotal($items)
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item->total;
        }

        return $subtotal;
    }
    public function getTotalWeight($items)
    {
        $total_weight = 0;
        foreach ($items as $item) {
            $total_weight += $item->product->weight;
        }

        return $total_weight;
    }
    public function getservicecost($result, string $service)
    {
        return array_values(array_filter($result->results[0]->costs,  function ($res) use ($service) {
            return $res->service == $service;
        }))[0]->cost[0]->value;
    }

    protected function do_order($data_order)
    {
        $token = auth_user_id() . time();
        $transaction = null;

        switch ($data_order['payment_option']) {
            case 'bank_transfer':
                switch ($data_order['option_payment']) {
                    case 'bank_permata':
                        $transaction = $this->payment->bank_transfer(BANK::PERMATA, ["order_id" => $token, "gross_amount" => $data_order['subtotal']]);
                        break;
                    case 'bank_bni':
                        $transaction = $this->payment->bank_transfer(BANK::BNI, ["order_id" => $token, "gross_amount" => $data_order['subtotal']]);
                        break;
                    case 'bank_bca':
                        $transaction = $this->payment->bank_transfer(BANK::BCA, ["order_id" => $token, "gross_amount" => $data_order['subtotal']]);
                        break;
                    case 'bank_mandiri':
                        $transaction = $this->payment->bank_transfer(BANK::MANDIRI, ["order_id" => $token, "gross_amount" => $data_order['subtotal']]);
                        break;
                    case 'bank_bri':
                        $transaction = $this->payment->bank_transfer(BANK::BRI, ["order_id" => $token, "gross_amount" => $data_order['subtotal']]);
                        break;
                    default:
                        $transaction = null;
                        break;
                }
                break;
            case "e_money":
                switch ($data_order['option_payment']) {
                    case 'qris':
                        $transaction = $this->payment->e_money(EMONEY::QRIS, ["order_id" => $token, "gross_amount" => $data_order['subtotal']], auth_user_id());
                        break;
                    default:
                        $transaction = null;
                        break;
                }
            default:
                $transaction = null;
                break;
        }

        if($transaction != null){
            dd($transaction);
        }else{
            dd("null");
        }

    }
}
