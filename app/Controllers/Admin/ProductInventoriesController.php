<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductInventoriesController extends BaseController
{
    private Product $product;
    public function __construct()
    {
        $this->product  = new Product();
    }
    public function index()
    {
        $data['products'] = $this->product->find();
        return view("admin/product/inventories/index", add_data("Inventories Product", "product/inventories", $data));
    }
    public function stockChange()
    {
        if ($this->request->isAJAX()) {
            if($this->validate(["id"=>"required","stock"=>"required"])){
                try {
                    $productid = $this->request->getVar("id");
                    $stock = (int) $this->request->getVar("stock");
                    $update = $this->product->update($productid, ['stock'=> $stock]);
                    if ($update) {
                        return $this->response->setJSON(["success" => true]);
                    }
                } catch (\Exception $e) {
                    dd($e);
                    return $this->response->setStatusCode(500);
                }
            }else{
                return $this->response->setStatusCode(500)->setJSON(["err" => $this->validator->getErrors()]);
            }
        }
    }
}
