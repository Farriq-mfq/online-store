<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ShippingController extends BaseController
{
    public function index()
    {
        //
    }

    public function getProvince()
    {

        if ($this->request->isAJAX()) {
            try {
                $pr = $this->shipping->get_province();
                return $this->response->setStatusCode(200)->setJSON($pr);
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
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
                return $this->response->setStatusCode(200)->setJSON(array_values($filter));
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
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
                    $res = $this->shipping->get_cost($this->request->getVar("destination"), $this->request->getVar("weight"), $this->request->getVar("courier"));
                    return $this->response->setStatusCode(200)->setJSON($res);
                } else {
                    return $this->response->setStatusCode(400)->setJSON($this->validator->getErrors());
                }
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500);
            }
        }
    }
}
