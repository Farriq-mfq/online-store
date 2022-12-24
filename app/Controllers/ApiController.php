<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ApiController extends BaseController
{
    public function index()
    {
        //
    }

    public function get_product()
    {
        if ($this->request->isAJAX()) {

            $validate = $this->validate(['id'=>'required|numeric']);
            if($validate){
                try {
                    $product = new Product();
                    $id = $this->request->getVar("id");
                    $product = $product->find($id);
                    return $this->response->setStatusCode(200)->setJSON($product);
                } catch (\Exception $e) {
                    return $this->response->setStatusCode(500)->setJSON(['error'=>"Internal Server error"]);
                }
            }else{
                return $this->response->setStatusCode(400)->setJSON(['error'=>$this->validator->getErrors()]);
            }
        }
    }
}
