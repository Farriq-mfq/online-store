<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;

class ProductController extends BaseController
{
    private Product $products;

    public function __construct()
    {
        $this->products = new Product();
    }
    public function index()
    {
        $data['products'] =  $this->products->findAll();
        return view("admin/product/index",add_data("All Product","product/index",$data));
    }
    public function create()
    {
        $category = new Categories();
        $brand = new Brands();
        $data['categories'] = $category->find();
        $data['brands'] = $brand->find();
        return view("admin/product/add_new",add_data("Add New Product","product/new",$data));
    }
    public function add()
    {
        $validate = $this->validate([
            "title"=> [
                "rules"=>"required|is_unique[products.title]|max_length[150]"
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
            "product_image"=>[
                'rules' => 'uploaded[product_image]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,2048]',
                "errors"=>[
                    "uploaded"=>"Please Put Image",
                    "is_image"=>"Your File is not an image",
                    "mime_in"=>"Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size"=>"File size is only 2mb"
                ]
            ],
            "tags"=>"required",
        ]);
        if(!$validate){
            session()->setFlashdata('input_inventories',$this->request->getVar("send_input_inventories"));
            session()->setFlashdata('validation',$this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $title = $this->request->getVar("title");
        $description = $this->request->getVar('description');
        $short_description = $this->request->getVar('short_description');
        $category = $this->request->getVar('category');
        $content = htmlentities($this->request->getVar('content'));
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
        $product_image = $this->request->getFile("product_image")->getRandomName();
        $tags = $this->request->getVar('tags');
        $data = [
            "title"=>$title,
            "slug"=>url_title($title,"-"),
            "short_description"=>$short_description,
            "description"=>$description,
            "category_id"=>$category,
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
            "brand_id"=>$brand,
            "product_image"=>[
                "image"=>base_url("/uploads/products/".$product_image),
                "mime"=>$this->request->getFile("product_image")->getMimeType(),
                "name"=>$product_image,
                "is_primary"=>true
            ],
            "tags"=>explode(",",$tags)
        ];

        if($this->products->addNew($data)){
            alert("Publish Product Success","success");
            $this->request->getFile("product_image")->move("uploads/products",$product_image);
        }else{
            alert("Internal Server Error","error");
        }
        return redirect()->back();
        
    }
    public function remove($id)
    {
        try{
            $this->products->delete($id);
            alert("Success delete product","success");
        }catch(\Exception $e){
            alert("Internal server error","error");
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $category = new Categories();
        $brand = new Brands();
        $product = new Product();
        $data['categories'] = $category->find();
        $data['brands'] = $brand->find();
        $data['product'] = $product->find($id);
        return view("admin/product/edit",add_data("Edit Product","product/edit",$data));
    }
    public function status($id)
    {
        if($this->products->active_inactive($id)){
            alert("Success Update Status","success");
        }else{
            alert("Internal server error","danger");
        }
        return redirect()->back();
    }
    public function featured($id)
    {
        if($this->products->featured_unfeatured($id)){
            alert("Success Update Featured","success");
        }else{
            alert("Internal server error","danger");
        }
        return redirect()->back();
    }
    public function new_label($id)
    {
        if($this->products->new_label_remove_label($id)){
            alert("Success Update New Label","success");
        }else{
            alert("Internal server error","danger");
        }
        return redirect()->back();
    }
    public function update($id)
    {
        $originalTitle = $this->products->find($id)->title;
        if($this->request->getVar("title")!= $originalTitle){
            $unique = "|is_unique[products.title]";
        }else{
            $unique = "";
        }
        $validate = $this->validate([
            "title"=> [
                "rules"=>"required|max_length[150]".$unique.""
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
            "price"=> [
                "rules"=>"required|numeric"
            ],
            "weight"=> [
                "rules"=>"required|numeric"
            ],
            "brand"=> [
                "rules"=>"required"
            ],
        ]);
        if(!$validate){
            session()->setFlashdata('input_inventories',$this->request->getVar("send_input_inventories"));
            session()->setFlashdata('validation',$this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $title = $this->request->getVar("title");
        $description = $this->request->getVar('description');
        $short_description = $this->request->getVar('short_description');
        $category = $this->request->getVar('category');
        $content = htmlentities($this->request->getVar("content"));
        $price = $this->request->getVar('price');
        $weight = $this->request->getVar('weight');
        $featured = $this->request->getVar('featured');
        $new_label = $this->request->getVar('new_label');
        $status = $this->request->getVar('status');
        $brand = $this->request->getVar('brand');
        $data = [
            "title"=>$title,
            "slug"=>url_title($title,"-"),
            "short_description"=>$short_description,
            "description"=>$description,
            "category_id"=>$category,
            "content"=>$content,
            "price"=>$price,
            "weight"=>$weight,
            "featured"=>$featured == NULL ? false:true,
            "new_label"=>$new_label== NULL ? false:true,
            "status"=>$status== NULL ? false:true,
            "brand_id"=>$brand,
        ];
        if($this->products->update_product((int)esc($id),$data)){
            alert("Update Product Success","success");
        }else{
            alert("Internal Server Error","error");
        }
        return redirect()->back();
    }
}
