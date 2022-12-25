<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ApiController extends BaseController
{
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function index()
    {
        header('Content-Type: text/html; charset=utf-8');

        $product = $this->product->with("product_reviews")->find($this->request->getVar('id'));
        $brand = $product->brand != null ? $product->brand->brand : "No Brand / Author";
        $stock = $product->stock > 0 ? "In Stock" : "Out Of Stock";
        $stock_class = $product->stock > 0 ? "" : "text-danger";
        $tags = count($this->product->getTagsProduct($product->product_id)) ? $this->printtags($this->product->getTagsProduct($product->product_id)) : "-";
        if ($product) {
            return '<div class="product-details-info pl-lg--30">
                <p class="tag-block">Tags: ' . $tags . '</p>
                <h3 class="product-title">' . $product->title . '</h3>
                <ul class="list-unstyled">
                    <li>Brands: <a href="#" class="list-value font-weight-bold"> ' . $brand . '</a></li>
                    <li>Availability: <span class="list-value ' . $stock_class . '"> ' . $stock . '</span></li>
                </ul>
                <div class="price-block">
                ' . $this->printPrice($product) . '
                </div>
                <div class="rating-widget">
                    <div class="rating-block">
                        ' . $this->printRating($product->product_reviews) . '
                    </div>
                    <div class="review-widget">
                        <a href="'.base_url("/shop")."/".$product->slug.'">(' . count($product->product_reviews) . ' Reviews)</a> <span>|</span>
                        <a href="'.base_url("/shop")."/".$product->slug.'">Write a review</a>
                    </div>
                </div>
                <article class="product-details-article">
                    <h4 class="sr-only">Product Summery</h4>
                    <p>' . $product->short_description . '.</p>
                </article>
                <div class="add-to-cart-row">
                    <div class="count-input-block">
                        <span class="widget-label">Qty</span>
                        <input type="number" class="form-control text-center" value="1">
                    </div>
                    <div class="add-cart-btn">
                        <a href="#" class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to Cart</a>
                    </div>
                </div>
                <div class="compare-wishlist-row">
                    <a href="#" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                    <a href="#" class="add-link"><i class="fas fa-random"></i>Add to Compare</a>
                </div>
            </div>';
        }
    }

    protected function printtags($tags)
    {
        $html = "";

        foreach ($tags as $tag) {
            $html .= '<a href="#">' . $tag->tag . '</a>,';
        }

        return $html;
    }

    protected function printRating($reviews)
    {
        $html = '';
        if ($reviews) {
            for ($i = 0; $i < 5; $i++) {
                if (get_avg($reviews, "rating") <= $i) {
                    $html .= '<span class="fas fa-star"></span>';
                } else {
                    $html .= '<span class="fas fa-star star_on"></span>';
                }
            }
        } else {
            for ($i = 0; $i < 5; $i++) {
                $html .= '<span class="fas fa-star"></span>';
            }
        }

        return $html;
    }
    protected function printPrice($product)
    {
        $html = '';
        if (count($product->product_discount)) {
            foreach ($product->product_discount as $discount) {
                if ($discount->discount_type === "PERCENTAGE") {
                    return '<span class="price">' . format_rupiah(get_discount($product->price, $discount->discount_value)) . '</span>
                    <del class="price-old">' . format_rupiah($product->price) . '</del>
                    <span class="price-discount">' . $discount->discount_value . '%</span>';
                } elseif ($discount->discount_type === "VALUE") {
                    return '<span class="price">' . format_rupiah(get_less_price($product->price, $discount->discount_value)) . '</span>
                    <del class="price-old">' . format_rupiah($product->price) . '</del>
                    <span class="price-discount">' . thousandsCurrencyFormat($discount->discount_value) . '</span>';
                } else {
                    return '<span class="price">' . format_rupiah($product->price) . '</span>';
                }
            }
        } else {
            $html .= '<span class="price">' . format_rupiah($product->price) . '</span>';
        }

        return $html;
    }

    public function get_product()
    {
        if ($this->request->isAJAX()) {

            $validate = $this->validate(['id' => 'required|numeric']);
            if ($validate) {
                try {
                    $product = new Product();
                    $id = $this->request->getVar("id");
                    $product = $product->find($id);
                    return $this->response->setStatusCode(200)->setJSON($product);
                } catch (\Exception $e) {
                    return $this->response->setStatusCode(500)->setJSON(['error' => "Internal Server error"]);
                }
            } else {
                return $this->response->setStatusCode(400)->setJSON(['error' => $this->validator->getErrors()]);
            }
        }
    }
}
