<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    private Product $product;
    public function __construct()
    {
        $this->products = new Product();
    }
    public function index()
    {
        $data['products'] = $this->products->with("product_images")->where("status",true)->find();
        return view('client/shop/index',add_data("All Products","product/index",$data));
    }
    public function detail($slug)
    {
        $product = $this->products->with("product_images")->where("slug",$slug)->first();
        $data['product'] = $product;
        $data['availible_stock'] = $this->products->checkAvailableStock($product->product_id);
        return view('client/shop/detail',add_data($slug,"product/detail",$data));
    }
}
