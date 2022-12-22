<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductComments as ModelsProductComments;

class ProductComments extends BaseController
{
    private ModelsProductComments $productComments;
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
        $this->productComments = new ModelsProductComments();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_comments")->findAll(); 
        $data['userComments'] = $this->productComments->select("comment_id","user_id")->with("users")->findAll();
        return view("admin/product/comments/index",add_data("Comments Product","product/comments",$data));
    }
}
