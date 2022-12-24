<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductReviews;

class ShopControlller extends BaseController
{
    private Product $product;
    private ProductReviews $product_reviews;
    public function __construct()
    {
        $this->product_reviews = new ProductReviews();
        $this->product = new Product();
    }
    public function index()
    {
        $perpage = htmlentities($this->request->getVar('perpage')) ? htmlentities($this->request->getVar('perpage')) : 6;
        $data['products'] = $this->getOrderBy($this->request->getVar('sort'), $perpage);
        $data['pager'] = $this->product->pager;
        $data["number"] = getCurrentNumber($this->product->pager->getDetails("product")["currentPage"], $this->product->pager->getDetails("product")["perPage"]);
        $data["end"] = getEndPage($this->product->pager->getDetails("product")["currentPage"], $this->product->pager->getDetails("product")["perPage"], $this->product->pager->hasMore("product"), $this->product->pager->getDetails("product")['total']);
        return view("/client/shop/index", add_data("Shop", "shop/index", $data));
    }

    protected function getOrderBy($sort, $perpage)
    {
        if ($sort) {
            switch (htmlentities($sort)) {
                case "a-z":
                    return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
                case "z-a":
                    return  $this->product->where("status", 1)->with("product_reviews")->orderBy("title", "DESC")->paginate($perpage, "product");
                case 'low-high':
                    return  $this->product->where("status", 1)->with("product_reviews")->orderBy("price", "ASC")->paginate($perpage, "product");
                case 'high-low':
                    return  $this->product->where("status", 1)->with("product_reviews")->orderBy("price", "DESC")->paginate($perpage, "product");
                case "rating_highest":
                    $reviews = $this->product_reviews->orderBy("AVG(rating)", "DESC")->select("product_id,AVG(rating)")->groupBy("product_id")->findAll();
                    $pid = [];
                    foreach ($reviews as $review) {
                        $pid[] = $review->product_id;
                    }
                    return  $this->product->where("status", 1)->with("product_reviews")->whereIn("product_id",$pid)->paginate($perpage, "product");
                case "rating_lowest":
                    $reviews = $this->product_reviews->orderBy("AVG(rating)", "ASC")->select("product_id,AVG(rating)")->groupBy("product_id")->findAll();
                    $pid = [];
                    foreach ($reviews as $review) {
                        $pid[] = $review->product_id;
                    }
                    return  $this->product->where("status", 1)->with("product_reviews")->whereIn("product_id",$pid)->paginate($perpage, "product");
                default:
                    return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
                    break;
            }
        } else {
            return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
        }
    }
}
