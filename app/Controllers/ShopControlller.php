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
        $keyword = $this->request->getVar("q") ? htmlentities($this->request->getVar("q")) : "";
        $category_id = $this->request->getVar("category_id") ? htmlentities($this->request->getVar("category_id")) : "";
        $perpage = $this->request->getVar('perpage') ? htmlentities($this->request->getVar('perpage')) : 6;
        $data['products'] = $this->getOrderBy($this->request->getVar('sort'), $perpage, $keyword, $category_id);
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
    protected function getOrderBy($sort, $perpage, $q = "", $ct = "")
    {
        if ($sort) {
            switch (htmlentities($sort)) {
                case "a-z":
                    if (!empty($q)) {
                        return $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->orderBy("title", "ASC")->paginate($perpage, "product");
                    } elseif (!empty($ct)) {
                        return $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->orderBy("title", "ASC")->paginate($perpage, "product");
                    } else {
                        return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
                    }
                case "z-a":
                    if (!empty($q)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->orderBy("title", "DESC")->paginate($perpage, "product");
                    } elseif (!empty($ct)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->orderBy("title", "DESC")->paginate($perpage, "product");
                    } else {
                        return  $this->product->where("status", 1)->with("product_reviews")->orderBy("title", "DESC")->paginate($perpage, "product");
                    }
                case 'low-high':
                    if (!empty($q)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->orderBy("price", "ASC")->paginate($perpage, "product");
                    } elseif (!empty($ct)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->orderBy("price", "ASC")->paginate($perpage, "product");
                    } else {
                        return  $this->product->where("status", 1)->with("product_reviews")->orderBy("price", "ASC")->paginate($perpage, "product");
                    }
                case 'high-low':
                    if (!empty($q)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->orderBy("price", "DESC")->paginate($perpage, "product");
                    } elseif (!empty($ct)) {
                        return  $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->orderBy("price", "DESC")->paginate($perpage, "product");
                    } else {
                        return  $this->product->where("status", 1)->with("product_reviews")->orderBy("price", "DESC")->paginate($perpage, "product");
                    }
                case "rating_highest":
                    return  $this->product->getratingHigh($perpage, 'product', $q, $ct);
                case "rating_lowest":
                    return  $this->product->getratinglow($perpage, 'product', $q, $ct);
                case "brand_a_z":
                    return  $this->product->get_brand_a_z($perpage, "product", $q, $ct);
                case "brand_z_a":
                    return  $this->product->get_brand_z_a($perpage, "product", $q, $ct);
                default:
                    if (!empty($q)) {
                        return $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->paginate($perpage, "product");
                    } elseif (!empty($ct)) {
                        return $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->paginate($perpage, "product");
                    } else {
                        return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
                    }
                    break;
            }
        } else {
            if (!empty($q)) {
                return $this->product->where("status", 1)->with("product_reviews")->like("title", "%" . $q . "%")->paginate($perpage, "product");
            } elseif (!empty($ct)) {
                return $this->product->where("status", 1)->with("product_reviews")->where("category_id", $ct)->paginate($perpage, "product");
            } else {
                return $this->product->where("status", 1)->with("product_reviews")->paginate($perpage, "product");
            }
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

    // details product

    public function detail($slug)
    {
        if ($slug) {
            try {
                $slug = htmlentities($slug);
                $product = $this->product->with("product_reviews")->where("status", 1)->where("slug", $slug)->first();
                if ($product != null) {
                    $data['tags'] = $this->product->getTagsProduct($product->product_id);
                    $data['product'] = $product;
                    $data['reviews'] = $this->product->getreviews($product->product_id);
                    $data['relateds'] = $this->product->getProductRelated($product->product_id);
                    return view("client/shop/product-detail", add_data($product->title, "shop/detail", $data));
                } else {
                    return redirect()->to("/shop");
                }
            } catch (\Exception $e) {

                dd($e);
                return redirect()->to("/shop");
            }
        } else {
            return redirect()->to("/shop");
        }
    }

    public function postReviews($productId)
    {
        $validate = $this->validate([
            'star' => "required",
            'review' => 'required'
        ]);
        if ($validate) {
            $data = [
                'rating' => $this->request->getVar('star'),
                'review' => $this->request->getVar('review'),
                'user_id' => auth_user_id(),
                'product_id' => $productId
            ];

            $insert = $this->product_reviews->insert($data);
            if ($insert) {
                session()->setFlashdata("alert_success", "Success Post review");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
    }
}
