<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Offer;
use App\Models\Product;

class OfferController extends BaseController
{
    private Offer $offer;
    private Product $product;
    public function __construct()
    {
        $this->offer = new Offer();
        $this->product = new Product();
    }
    public function index()
    {
        $data['offers'] = $this->offer->with("products")->findAll();
        $data['products'] = $this->product->findAll();
        return view('admin/offer/index', add_data("All Offer", "offer/index", $data));
    }
    public function store()
    {
        $validate = $this->validate(
            [
                "product_id" => [
                    "rules" => "required|is_unique[offers.product_id]",
                    "errors" => [
                        "is_unique" => "Product Already special offer"
                    ]
                ],
                "offer_start_end" => 'required',
            ]
        );
        if ($validate) {
            $datetime = explode("-", $this->request->getVar("offer_start_end"));
            $start = str_replace("/", "-", trim($datetime[0]));
            $end = str_replace("/", "-", trim($datetime[1]));
            $data = [
                'product_id' => $this->request->getVar("product_id"),
                "offer_start" => $start,
                "offer_end" => $end
            ];
            if ($start < date("Y-m-d H:i:s") && $end < date("Y-m-d H:i:s")) {
                alert("Invalid Datetime", "error");
            } else {
                $this->offer->insert($data);
                alert("Success add Offer", "success");
            }
            return redirect()->back();
        } else {
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
    }
    public function get_update_offer()
    {
        if ($this->request->isAJAX()) {
            header('Content-Type: application/json');
            $offer = $this->offer->without("products")->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($offer);
        }
    }
    public function update()
    {
        $validate = $this->validate(
            [
                "offer_start_end" => 'required',
            ]
        );
        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("offer_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
        } else {
            try {
                $datetime = explode("-", $this->request->getVar("offer_start_end"));
                $start = str_replace("/", "-", trim($datetime[0]));
                $end = str_replace("/", "-", trim($datetime[1]));
                $data = [
                    "offer_start" => $start,
                    "offer_end" => $end
                ];
                if ($start < date("Y-m-d H:i:s") && $end < date("Y-m-d H:i:s")) {
                    alert("Invalid Datetime", "error");
                } else {
                    $this->offer->update((int)esc($this->request->getVar("offer_id")), $data);
                    alert("Success update offer", "success");
                }
            } catch (\Exception $e) {
                alert("Internal Server error", "error");
            }
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $this->offer->delete($id);
            alert("Success delete Offer", "success");
        } catch (\Exception $e) {
            alert("Failed delete Offer", "error");
        }
        return redirect()->back();
    }
}
