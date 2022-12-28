<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\UserAddress;

class AccountController extends BaseController
{
    private Order $order;
    private OrderItem $order_item;
    private UserAddress $address;
    public function __construct()
    {
        $this->order = new Order();
        $this->order_item = new OrderItem();
        $this->address = new UserAddress();
    }
    public function index()
    {
        try {
            if ($this->request->getVar("tab")) {
                $tab = htmlentities($this->request->getVar("tab"));
                $data['target_tab'] = $tab;
            } else {
                return redirect()->to('/account?tab=dashboard');
            }
            $user = new User();
            $data['orders'] = array_values($this->order->where('user_id', auth_user_id())->findAll());
            $data['downloads'] = $this->order->where('user_id', auth_user_id())->where("status", "SHIPPED")->findAll();
            $data['addresses'] = $this->address->where("user_id", auth_user_id())->with('users')->findAll();
            $data['user'] = $user->find(auth_user_id());
            $data['payments'] = $this->order->getPaymentStatus();
            return view('client/account/index', add_data("Account", "account/index", $data));
        } catch (\Exception $e) {
            session()->setFlashdata("alert_error", "Something went wrong");
            return redirect()->back();
        }
    }
    public function add_address()
    {
        if ($this->request->getVar('__id_address')) {
            $id = htmlentities($this->request->getVar('__id_address'));
            $validate = [
                '__id_address' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required|numeric',
                'address1' => 'required',
                'province' => 'required|numeric',
                'city' => 'required|numeric',
                'postcode_zip' => 'required|numeric',
            ];
        } else {
            $validate = [
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required|numeric',
                'address1' => 'required',
                'province' => 'required|numeric',
                'city' => 'required|numeric',
                'postcode_zip' => 'required|numeric',
            ];
        }

        if ($this->validate($validate)) {
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
                'user_id' => auth_user_id()
            ];
            if ($this->request->getVar('__id_address')) {

                $user_id_address = $this->address->update($id, $data_address);
                if ($user_id_address) {
                    session()->setFlashdata("alert_success", "Success Update Address");
                    return redirect()->to('account?tab=address-edit');
                }
            } else {
                $user_id_address = $this->address->insert($data_address);
                if ($user_id_address) {
                    session()->setFlashdata("alert_success", "Success Add address");
                    return redirect()->to('account?tab=address-edit');
                }
            }
        } else {
            session()->setFlashdata("show_modal", true);
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->to('account?tab=address-edit');
        }
    }

    public function set_address_default($id)
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
    public function set_address_edit()
    {
        if ($this->request->isAJAX()) {
            if ($this->validate(['id' => 'required|numeric'])) {

                if ($this->request->getVar('id')) {
                    $id = htmlentities($this->request->getVar('id'));
                    return $this->response->setJSON($this->address->find($id));
                }
            } else {
                return $this->response->setStatusCode(400)->setJSON(['validation' => $this->validator->getErrors()]);
            }
        }
    }

    public function account_update()
    {
        if (!empty($this->request->getVar('new_password'))) {
            $validate = [
                'name' => 'required',
                'email' => 'required|valid_email',
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|matches[new_password]'
            ];
        } else {
            $validate = [
                'name' => 'required',
                'email' => 'required|valid_email',
            ];
        }

        if ($this->validate($validate)) {
            $user = new User();

            if (!empty($this->request->getVar('new_password'))) {

                $current_password = htmlentities($this->request->getVar('current_password'));
                $checkuser = $user->where('user_id', auth_user_id())->first();
                $updateUser = $user->update(auth_user_id(), ['name' => htmlentities($this->request->getVar('name')), 'email' => htmlentities($this->request->getVar('email'))]);
                if ($updateUser) {
                    if (password_verify($current_password, $checkuser->password)) {
                        $hash = password_hash(htmlentities($this->request->getVar('new_password')), PASSWORD_DEFAULT);
                        $update = $user->update($checkuser->user_id, ['password' => $hash]);
                        if ($update) {
                            session()->setFlashdata('alert_success', 'Success update account');
                            return redirect()->to('/account?tab=account-info');
                        }
                    } else {
                        session()->setFlashdata('validation', ['current_password' => "Password wrong"]);
                        return redirect()->to('/account?tab=account-info');
                    }
                }
            } else {
                $user->update(auth_user_id(), ['name' => htmlentities($this->request->getVar('name')), 'email' => htmlentities($this->request->getVar('email'))]);
                session()->setFlashdata('alert_success', 'Success update account');
                return redirect()->to('/account?tab=account-info');
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to('/account?tab=account-info');
        }
    }

    public function view()
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
                return view('client/account/view', add_data('Checkout Complete', "checkout/complete", $data));
            } else {
                return redirect()->to('/account?tab=orders');
            }
        } catch (\Exception $e) {
            return redirect()->to('/account?tab=orders');
        }
    }
}
