<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $products = new Product();
        $data['products'] =  $products->find();
        return view("admin/product/index",add_data("All Product","product/index",$data));
    }
    public function create()
    {
        return view("admin/product/add_new",add_data("Add New Product","product/new"));
    }
    public function add()
    {
        $validate = $this->validate([
            "title"=> [
                "rules"=>"required|is_unique[products.title,product_id,{products.product_id}]"
            ],
            "description"=> [
                "rules"=>"required"
            ],
            "category"=> [
                "rules"=>"required"
            ],
            "content"=> [
                "rules"=>"required"
            ],
            "inventories_size.*"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field size empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "inventories_color.*"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Field color empty"
                ]
            ],
            "inventories_stock.*"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field stock empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "inventories_sku.*"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field sku empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "inventories_price.*"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field price empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "price"=> [
                "rules"=>"required|numeric"
            ],
            "weight"=> [
                "rules"=>"required|numeric"
            ],
            "brand"=> [
                "rules"=>"required"
            ],
            "tags"=>"required",
        ]);
        if(!$validate){
            session()->setFlashdata('input_inventories',$this->request->getVar("send_input_inventories"));
            session()->setFlashdata('validation',$this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $product = new Product();
        $title = $this->request->getVar("title");
        $description = $this->request->getVar('description');
        $short_description = $this->request->getVar('short_description');
        $category = $this->request->getVar('category');
        $content = $this->request->getVar('content');
        $inventories_size = $this->request->getVar('inventories_size');
        $inventories_color = $this->request->getVar('inventories_color');
        $inventories_stock = $this->request->getVar('inventories_stock');
        $inventories_sku = $this->request->getVar('inventories_sku');
        $inventories_price = $this->request->getVar('inventories_price');
        $price = $this->request->getVar('price');
        $weight = $this->request->getVar('weight');
        $featured = $this->request->getVar('featured');
        $new_label = $this->request->getVar('new_label');
        $status = $this->request->getVar('status');
        $brand = $this->request->getVar('brand');
        $tags = $this->request->getVar('tags');
        $data = [
            "title"=>$title,
            "slug"=>url_title($title,"-"),
            "short_description"=>$short_description,
            "description"=>$description,
            "product_categorie_id"=>$category,
            "content"=>$content,
            "inventories"=>[
                'size'=>$inventories_size,
                'color'=>$inventories_color,
                'stock'=>$inventories_stock,
                'sku'=>$inventories_sku,
                'price'=>$inventories_price,
            ],
            "price"=>$price,
            "weight"=>$weight,
            "featured"=>$featured == NULL ? false:true,
            "new_label"=>$new_label== NULL ? false:true,
            "status"=>$status== NULL ? false:true,
            "product_brand_id"=>$brand,
            "tags"=>explode(",",$tags)
        ];
        $product->addNew($data);
        alert("Publish Product Success","success");
        return redirect()->back();
    }
    public function remove($id)
    {
        $products = new Product();
        $products->delete($id);
        alert("Success delete product","success");
        return redirect()->back();
    }
}
