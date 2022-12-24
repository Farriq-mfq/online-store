<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductDiscount;

class ProductDiscountController extends BaseController
{
    private Product $product;
    private ProductDiscount $productDiscount;
    public function __construct()
    {
        $this->product = new Product();
        $this->productDiscount = new ProductDiscount();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_discount")->findAll();
        return view("admin/product/discount/index", add_data("Discount Product", "product/discount", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $discount = $this->productDiscount->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($discount);
        }
    }
    public function store($productID)
    {
        $validate = $this->validate([
            "discount_type" => [
                'rules' => 'required',
            ],
            "discount_value" => [
                'rules' => 'required|numeric',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_discount", admin_url("/product/discount/" . $productID));
            return redirect()->back()->withInput();
        }
        $data = [
            "discount_type" => $this->request->getVar('discount_type'),
            "discount_value" => $this->request->getVar('discount_value'),
            "product_id" => $productID
        ];

        $checkIfissetdiscount = $this->productDiscount->where("product_id", $productID)->first();
        if ($checkIfissetdiscount != null) {
            alert("discount already added", "error");
        } else {
            $product = $this->product->find($productID);
            if ($this->request->getVar('discount_type') == "PERCENTAGE") {
                if ($this->request->getVar('discount_value') > 100) {
                    alert("discount Invalid", "error");
                } else {
                    if ($this->productDiscount->insert($data)) {
                        alert("Success Add Discount", "success");
                    }
                }
            } else {
                if ($this->request->getVar('discount_value') >= $product->price) {
                    alert("discount Invalid", "error");
                } else {
                    if ($this->productDiscount->insert($data)) {
                        alert("Success Add Discount", "success");
                    }
                }
            }
        }
        return redirect()->back();
    }
    public function update($id)
    {
        $validate = $this->validate([
            "discount_type" => [
                'rules' => 'required',
            ],
            "discount_value" => [
                'rules' => 'required|numeric',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_discount", admin_url("/product/discount/" . $id));
            return redirect()->back()->withInput();
        }
        $data = [
            "discount_type" => $this->request->getVar('discount_type'),
            "discount_value" => $this->request->getVar('discount_value'),
        ];
        $discount = $this->productDiscount->find($id);
        $product = $this->product->where("product_id", $discount->product_id)->first();
        if ($this->request->getVar('discount_type') == "PERCENTAGE") {
            if ($this->request->getVar('discount_value') > 100) {
                alert("discount Invalid", "error");
            } else {
                if ($this->productDiscount->update($id, $data)) {
                    alert("Success Update Discount", "success");
                }
            }
        }else{

            if ($this->request->getVar('discount_value') >= $product->price) {
                alert("discount Invalid", "error");
            } else {
                if ($this->productDiscount->update($id, $data)) {
                    alert("Success Update Discount", "success");
                }
            }
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $delete = $this->productDiscount->delete($id);
            if ($delete) {
                alert("Success delete Discount", "success");
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            alert("Internal Server error", "error");
        }
    }
}
