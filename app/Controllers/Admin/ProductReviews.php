<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductReviews as ModelsProductReviews;

class ProductReviews extends BaseController
{
    private ModelsProductReviews $productreviews;
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
        $this->productreviews = new ModelsProductReviews();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_reviews")->findAll();
        $data['userReviews'] = $this->productreviews->select("review_id","user_id")->with("users")->findAll();
        return view("admin/product/reviews/index", add_data("Reviews Product", "product/reviews",$data));
    }
}
