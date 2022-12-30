<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use App\Models\UserAddress;
use BANK;
use Config\Services;
use EMONEY;

class OrderController extends BaseController
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
        $this->cart = new ShoppingCart();
    }
    public function index()
    {
        //
    }

    public function do_order()
    {
        if ($this->address->where('user_id', auth_user_id())->countAllResults() > 0) {
            $rules = [
                "address_id" => 'required',
                "courier" => 'required',
                'service' => 'required',
                'payment_method' => [
                    'rules' => 'required',
                    "errors" => [
                        'required' => "Please Select Payment Method"
                    ]
                ],
                'term_conditions' => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "terms & conditions required checked"
                    ]
                ]
            ];
        } else {
            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required|numeric',
                'address1' => 'required',
                'province' => 'required|numeric',
                'city' => 'required|numeric',
                'postcode_zip' => 'required|numeric',
                "courier" => 'required',
                'service' => 'required',
                'payment_method' => [
                    'rules' => 'required',
                    "errors" => [
                        'required' => "Please Select Payment Method"
                    ]
                ],
                'term_conditions' => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "terms & conditions required checked"
                    ]
                ]
            ];
        }

        if (!$this->validate($rules)) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            try {
                if ($this->address->where('user_id', auth_user_id())->countAllResults() > 0) {
                    $address = $this->address->find($this->request->getVar('address_id'));
                    $payment_method = $this->request->getVar('payment_method');
                    $total_weight = $this->cart->getWeightProduct() != null ? $this->cart->getWeightProduct() : 0;
                    $ShippingResults = $this->shipping->get_cost($address->city, $total_weight->total_weight, $this->request->getVar("courier"));
                    $shipping_total = $this->shipping->filterCost($ShippingResults->results[0]->costs, $this->request->getVar('service'))[0]->cost[0]->value;
                    $grand_total = $this->cart->getGrandTotal($shipping_total);
                    $randomToken = auth_user_id() . uniqid();
                    $pay = $this->pay($payment_method, $randomToken, $grand_total);
                    if ($pay != null) {
                        $data_order = [
                            "midtrans_id" => $pay->transaction_id,
                            "token" => $randomToken,
                            "user_id" => auth_user_id(),
                            "courier" => $this->request->getVar('courier'),
                            "shipping_service" => $this->request->getVar('service'),
                            "origin" => $this->shipping->getOrigin(),
                            "destination_origin" => $address->city,
                            "notes" => $this->request->getVar('order-note'),
                            "shipping_total" => $shipping_total,
                            "subtotal" => $grand_total,
                            "payment_method" => $pay->payment_type,
                            "user_address_id" => $this->request->getVar('address_id'),
                        ];
                        $order_id = $this->order->insert($data_order);
                        if ($order_id) {
                            $carts = $this->cart->where('user_id', auth_user_id())->findAll();
                            foreach ($carts as $cart) {
                                $this->order_item->insert([
                                    'order_id' => $order_id,
                                    'product_id' => $cart->product->product_id,
                                    'quantity' => $cart->quantity,
                                    'total' => $cart->total
                                ]);
                                $this->cart->where('user_id', auth_user_id())->delete();
                            }
                        }
                        return redirect()->to("checkout/complete?token=" . $randomToken);
                    } else {
                        session()->setFlashdata("alert_error", "Payment Failed, Please Try Again");
                        return redirect()->back();
                    }
                } else {
                    $data_address = [
                        'firstname' => $this->request->getVar("firstname"),
                        'lastname' => $this->request->getVar("lastname"),
                        'phone' => $this->request->getVar("phone"),
                        'address1' => $this->request->getVar("address1"),
                        'address2' => $this->request->getVar("address2"),
                        'city' => $this->request->getVar("city"),
                        'province' => $this->request->getVar("province"),
                        'postcode_zip' => $this->request->getVar("postcode_zip"),
                        'address_notes' => $this->request->getVar("address_notes"),
                        'primary' => true,
                        'user_id' => auth_user_id()
                    ];
                    $user_id_address = $this->address->insert($data_address);
                    $payment_method = $this->request->getVar('payment_method');
                    $total_weight = $this->cart->getWeightProduct() != null ? $this->cart->getWeightProduct() : 0;
                    $ShippingResults = $this->shipping->get_cost($this->request->getVar('city'), $total_weight->total_weight, $this->request->getVar("courier"));
                    $shipping_total = $this->shipping->filterCost($ShippingResults->results[0]->costs, $this->request->getVar('service'))[0]->cost[0]->value;
                    $grand_total = $this->cart->getGrandTotal($shipping_total);
                    $randomToken = auth_user_id() . uniqid();
                    $pay = $this->pay($payment_method, $randomToken, $grand_total);
                    if ($pay != null) {
                        $data_order = [
                            "midtrans_id" => $pay->transaction_id,
                            "token" => $randomToken,
                            "user_id" => auth_user_id(),
                            "courier" => $this->request->getVar('courier'),
                            "shipping_service" => $this->request->getVar('service'),
                            "origin" => $this->shipping->getOrigin(),
                            "destination_origin" => $this->request->getVar('city'),
                            "notes" => $this->request->getVar('order-note'),
                            "shipping_total" => $shipping_total,
                            "subtotal" => $grand_total,
                            "payment_method" => $pay->payment_type,
                            "user_address_id" => $user_id_address,
                        ];
                        $order_id = $this->order->insert($data_order);
                        if ($order_id) {
                            $carts = $this->cart->where('user_id', auth_user_id())->findAll();
                            foreach ($carts as $cart) {
                                $this->order_item->insert([
                                    'order_id' => $order_id,
                                    'product_id' => $cart->product->product_id,
                                    'quantity' => $cart->quantity,
                                    'total' => $cart->total
                                ]);
                                $this->cart->where('user_id', auth_user_id())->delete();
                            }
                        }
                        return redirect()->to("checkout/complete?token=" . $randomToken);
                    } else {
                        session()->setFlashdata("alert_error", "Payment Failed, Please Try Again");
                        return redirect()->back();
                    }
                }
            } catch (\Exception $e) {
                session()->setFlashdata("alert_error", "Checkout Failed, Please Try Again");
                return redirect()->back();
            }
        }
    }
    protected function pay($payment_method, $token, $subtotal)
    {
        try {
            $enc = Services::encrypter();
            if (!empty($payment_method)) {
                $dec = $enc->decrypt(hex2bin($payment_method));
                $explode = explode("|", $dec);
                $payment_type = $explode[0];
                $provider = $explode[1];
                $payload = ["order_id" => $token, "gross_amount" => $subtotal];
                switch ($payment_type) {
                    case 'bank_transfer':
                        switch ($provider) {
                            case 'bank_bri':
                                return $this->payment->bank_transfer(BANK::BRI, $payload);
                            case 'bank_bni':
                                return $this->payment->bank_transfer(BANK::BNI, $payload);
                            case 'bank_bca':
                                return $this->payment->bank_transfer(BANK::BCA, $payload);
                            case 'bank_mandiri':
                                return $this->payment->bank_transfer(BANK::MANDIRI, $payload);
                            case 'bank_permata':
                                return $this->payment->bank_transfer(BANK::PERMATA, $payload);
                            default:
                                return null;
                        }
                        break;
                    case 'e_money':
                        switch ($provider) {
                            case 'qris':
                                return $this->payment->e_money(EMONEY::QRIS, $payload, auth_user_id(), $token);
                            default:
                                return null;
                        }
                        break;
                    default:
                        return null;
                        break;
                }
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function cencel($id)
    {
        if ($id) {
            try {
                $order = $this->order->find(htmlentities($id));
                if ($order->status === "WAITING") {
                    $payment = $this->payment->get_status($order->midtrans_id);
                    $pay_cencel = $this->pay_cencel($payment, $order);
                    if ($pay_cencel) {
                        $cencel = $this->order->update($id, ['is_cencel' => true, 'status' => "REJECT"]);
                        if ($cencel) {
                            session()->setFlashdata('alert_success', "Cenceled Success");
                            return redirect()->back();
                        }
                    } else {
                        session()->setFlashdata('alert_error', "Failed Cencel");
                        return redirect()->back();
                    }
                }
            } catch (\Exception $e) {
                session()->setFlashdata('alert_error', "Failed Cencel");
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function pay_cencel($payment, $order)
    {
        switch ($payment->transaction_status) {
            case 'settlement':
                $data_refund = array(
                    'refund_key' => "REFUND_" . auth_user_id() . uniqid(),
                    'amount' => (int) $order->subtotal,
                    'reason' => 'Cencel BY ' . user()['name']
                );
                return $this->payment->payment_refund($order->midtrans_id, $data_refund);
            case 'pending':
                return $this->payment->payment_cencel($order->midtrans_id);
            default:
                return $this->payment->payment_cencel($order->midtrans_id);
        }
    }
    public function done($id)
    {
        if ($id) {
            try {
                $done = $this->order->update(htmlentities($id), ['status' => "DONE"]);
                if ($done) {
                    session()->setFlashdata('alert_success', "Thank you");
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                session()->setFlashdata('alert_error', "Failed to change status");
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function generate_pdf($id)
    {
        $mpdf = new \Mpdf\Mpdf();
        $order = $this->order->with(['user_address', 'users'])->where('order_id', $id)->where('user_id',auth_user_id())->first();
        $data['order'] = $order;
        $data['order_items'] = $this->order_item->with('products')->where('order_id', $order->order_id)->findAll();
        $data['payment'] = $this->payment->get_status($order->midtrans_id);
        $data['address'] = $this->address->with('users')->find($order->user_address_id);
        if (!isset($data['payment']->va_numbers)) {
            $data['emoney'] = $this->order->getSessionEmoney($order->token);
        }
        $html = view('pdf/invoice', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output($order->token . '.pdf', 'D');
    }
}
