<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserAddress;
use App\Models\Website;
use mPDF;
use Mpdf\Mpdf as MpdfMpdf;

class OrderController extends BaseController
{
    private Order $order;
    private OrderItem $order_item;
    private Product $product;
    private UserAddress $address;
    public function __construct()
    {
        $this->order = new Order();
        $this->order_item = new OrderItem();
        $this->product = new Product();
        $this->address = new UserAddress();
    }
    public function index()
    {

        $data['orders'] = $this->order->orderBy("order_id", "DESC")->findAll();
        return view('admin/order/index', add_data("All order", 'order/index', $data));
    }
    public function accept($id)
    {
        if ($id) {
            $order = $this->order->find($id);
            if ($order) {
                $update_status_order = $this->order->update($id, ['status' => "PROCESS"]);
                if ($update_status_order) {
                    foreach ($order->order_items as $item) {
                        $product = $this->product->find($item->product_id);
                        $this->product->update($item->product_id, ['stock' => $product->stock - 1]);
                    }
                    alert("Update Status", "success");
                    return redirect()->back();
                }
            } else {
                alert("Update Status Failed", 'error');
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function reject($id)
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
                            alert("Cenceled Success", "success");

                            return redirect()->back();
                        }
                    } else {
                        alert("Cencel Failed", 'error');
                        return redirect()->back();
                    }
                }
            } catch (\Exception $e) {
                alert("Internal server error", 'error');
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
    public function view_detail($orderId)
    {

        if ($orderId) {
            $order = $this->order->with(['user_address', 'users'])->where('token', $orderId)->first();
            $data['order'] = $order;
            $data['order_items'] = $this->order_item->with('products')->where('order_id', $order->order_id)->findAll();
            $data['payment'] = $this->payment->get_status($order->midtrans_id);
            $data['address'] = $this->address->with('users')->find($order->user_address_id);
            if (!isset($data['payment']->va_numbers)) {
                $data['emoney'] = $this->order->getSessionEmoney($order->token);
            }
            return view('/admin/order/view', add_data("Invoice", 'order/view', $data));
        } else {
            return redirect()->back();
        }
    }
    public function tracking_add($id)
    {

        if ($id) {
            $validate = $this->validate(['tracking' => 'required']);
            if ($validate) {
                try {
                    $done = $this->order->update(htmlentities($id), ['shipping_tracking' => $this->request->getVar('tracking'), 'status' => "SHIPPED"]);
                    if ($done) {
                        alert("Shipping Tracking success", "success");
                        return redirect()->back();
                    }
                } catch (\Exception $e) {
                    alert("Failed Tracking set", "errro");
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata(['validation' => $this->validator->getErrors()]);
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function generate_pdf($id)
    {
        $mpdf = new \Mpdf\Mpdf();
        $order = $this->order->with(['user_address', 'users'])->where('order_id', $id)->first();
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
    public function waiting()
    {
        $data['orders'] = $this->order->where("status", "WAITING")->findAll();
        return view('admin/order/index', add_data("Waiting order", 'order/waiting', $data));
    }
    public function process()
    {
        $data['orders'] = $this->order->where("status", "PROCESS")->findAll();
        return view('admin/order/index', add_data("Process order", 'order/process', $data));
    }
    public function shipped()
    {
        $data['orders'] = $this->order->where("status", "SHIPPED")->findAll();
        return view('admin/order/index', add_data("Shipped order", 'order/shipped', $data));
    }
    public function done()
    {
        $data['orders'] = $this->order->where("status", "DONE")->findAll();
        return view('admin/order/index', add_data("Done order", 'order/done', $data));
    }
    public function reject_view()
    {
        $data['orders'] = $this->order->where("status", "REJECT")->findAll();
        return view('admin/order/index', add_data("Rejected order", 'order/reject', $data));
    }
}
