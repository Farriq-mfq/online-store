<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductReviews;

class ShopControlller extends BaseController
{
    private Product $product;
    public function __construct()
    {
        $this->product_reviews = new ProductReviews();
        $this->product = new Product();
    }
    public function index()
    {
        $perpage = $this->request->getVar('perpage') ? htmlentities($this->request->getVar('perpage')) : 6;
        $data['products'] = $this->getOrderBy($this->request->getVar('sort'), $perpage);
        $data['pager'] = $this->product->pager;
        $data["number"] = getCurrentNumber($this->product->pager->getDetails("product")["currentPage"], $this->product->pager->getDetails("product")["perPage"]);
        $data["end"] = getEndPage($this->product->pager->getDetails("product")["currentPage"], $this->product->pager->getDetails("product")["perPage"], $this->product->pager->hasMore("product"), $this->product->pager->getDetails("product")['total']);
        $data['filters'] = $this->get_filters();
        $data['current_filter'] = $this->request->getVar('sort') ? htmlentities($this->request->getVar('sort')) : "";
        $data['filter_view'] = $this->filter_view($this->request->getVar("view"));
        return view("/client/shop/index", add_data("Shop", "shop/index", $data));
    }

    public function filter_view($view)
    {
        if ($view) {
            switch (htmlentities($view)) {
                case 'grid':
                    return "grid";
                case 'grid-four':
                    return "grid-four";
                case 'list':
                    return "list";
                default:
                    return "grid";
                    break;
            }
        } else {
            return "grid";
        }
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
                    return  $this->product->getratingHigh($perpage, 'product');
                case "rating_lowest":
                    return  $this->product->getratinglow($perpage, 'product');
                case "brand_a_z":
                    return  $this->product->get_brand_a_z($perpage, "product");
                case "brand_z_a":
                    return  $this->product->get_brand_z_a($perpage, "product");
                default:
                    return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
                    break;
            }
        } else {
            return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
        }
    }
    protected function get_filters()
    {
        return [
            [
                "title" => "Sort
                By:Title (A - Z)",
                "value" => "a-z",
            ],
            [
                "title" => "Sort
                By:Title (Z - A)",
                "value" => "z-a",
            ],
            [
                "title" => "Sort
                By:Price (Low &gt; High)",
                "value" => "low-high",
            ],
            [
                "title" => "Sort
                By:Price (High &gt; Low)",
                "value" => "high-low",
            ],
            [
                "title" => "Sort
                By:Rating (Highest)",
                "value" => "rating_highest",
            ],
            [
                "title" => "Sort
                By:Rating (Lowest)",
                "value" => "rating_lowest",
            ],
            [
                "title" => "Sort
                By:Brand (A - Z)",
                "value" => "brand_a_z",
            ],
            [
                "title" => "Sort
                By:Brand (Z - A)",
                "value" => "brand_z_a",
            ],
        ];
    }
}
