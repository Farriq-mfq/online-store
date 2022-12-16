<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Categories;
use App\Models\Product;

class ProductController extends BaseController
{
    private Product $product;
    private Categories $categories;
    public function __construct()
    {
        $this->products = new Product();
        $this->categories = new Categories();
    }
    public function index()
    {
        $data['products'] = $this->products->with("product_images")->where("status",true)->paginate(6,"product");
        $data['categories'] = $this->categories->getCategoriesByParentId();
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
