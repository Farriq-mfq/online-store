<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        return view("admin/product/index",add_data("All Product","product/index"));
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
                "rules"=>"required|min_length[0]"
            ],
            "inventories_color.*"=>[
                "rules"=>"required"
            ],
            "inventories_stock.*"=>[
                "rules"=>"required"
            ],
            "inventories_sku.*"=>[
                "rules"=>"required|min_length[0]"
            ],
            "inventories_price.*"=>[
                "rules"=>"required|min_length[0]"
            ],
            "price"=> [
                "rules"=>"required|min_length[0]"
            ],
            "weight"=> [
                "rules"=>"required|min_length[0]"
            ],
            "brand"=> [
                "rules"=>"required"
            ],
            "tags"=>"required"
        ]);
        if(!$validate){
            session()->setFlashdata('validation',$this->validator->getErrors());
            return redirect()->back();
        }

        $product = new Product();
        $title = $this->request->getVar("title");
        $description = $this->request->getVar('description');
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
        $meta_title = $this->request->getVar('meta_title');
        $meta_description = $this->request->getVar('meta_description');
        $tags = $this->request->getVar('tags');
        $data = [
            "title"=>$title,
            "slug"=>url_title($title,"-"),
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
            "meta_title"=>$meta_title,
            "meta_description"=>$meta_description,
            "tags"=>explode(",",$tags)
        ];
        $product->addNew($data);
    }
}
