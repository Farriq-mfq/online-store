<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ShoppingCart;

class ShippingController extends BaseController
{
    private ShoppingCart $cart;
    public function __construct()
    {
        $this->cart = new ShoppingCart();
    }

    public function getProvince()
    {

        if ($this->request->isAJAX()) {
            try {
                $pr = $this->shipping->get_province();
                $html = "";
                $html .= "<option value=''>Select Province</option>";
                foreach ($pr as $p) {
                    $html .= '<option value="' . $p->province_id . '">' . $p->province . '</option>';
                }
                return $html;
            } catch (\Exception $e) {
                return '<option value="">Select Province</option>';
            }
        }
    }
    public function cityByprovice()
    {

        if ($this->request->isAJAX()) {
            try {
                $provice = (int) $this->request->getVar("province_id");
                $city = $this->shipping->get_city();
                $filter = array_filter($city, function ($res) use ($provice) {
                    return $res->province_id == $provice;
                });
                $html = "";
                $html .= "<option value=''>Select City</option>";
                foreach (array_values($filter) as $c) {
                    $html .= '<option value="' . $c->city_id . '">' . $c->city_name . '</option>';
                }
                return $html;
            } catch (\Exception $e) {
                return '<option value="">Select City</option>';
            }
        }
    }
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                "destination" => "required",
                "weight" => "required|numeric",
                "courier" => "required"
            ]);
            try {
                if ($validate) {
                    $results = $this->shipping->get_cost($this->request->getVar("destination"), $this->request->getVar("weight"), $this->request->getVar("courier"));
                    $html =  "";
                    $html .= "<option value=''>Select Shipping Option</option>";
                    foreach ($results->results[0]->costs as $result) {
                        $html .= '<option value="' . $result->service . '">' . $result->description . ' ' . $result->cost[0]->value . ' (' . $result->cost[0]->etd . ')</option>';
                    }
                    return $html;
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
            }
        }
    }
    public function getPrice()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                "destination" => "required",
                "service" => "required",
                "weight" => "required|numeric",
                "courier" => "required"
            ]);
            try {
                if ($validate) {
                    $results = $this->shipping->get_cost($this->request->getVar("destination"), $this->request->getVar("weight"), $this->request->getVar("courier"));
                    return ''.format_rupiah($this->shipping->filterCost($results->results[0]->costs,$this->request->getVar('service'))[0]->cost[0]->value).'';
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
            }
        }
    }
    public function getGrand()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                "destination" => "required",
                "service" => "required",
                "weight" => "required|numeric",
                "courier" => "required"
            ]);
            try {
                if ($validate) {
                    $results = $this->shipping->get_cost($this->request->getVar("destination"), $this->request->getVar("weight"), $this->request->getVar("courier"));
                    return ''.format_rupiah($this->cart->getGrandTotal($this->shipping->filterCost($results->results[0]->costs,$this->request->getVar('service'))[0]->cost[0]->value)).'';
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
            }
        }
    }
}
