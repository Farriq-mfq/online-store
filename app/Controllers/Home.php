<?php

namespace App\Controllers;

use App\Models\Banner;
use App\Models\Categories;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Slider;
use Config\Services;

class Home extends BaseController
{
    protected Slider $slider;
    protected Product $product;
    protected Banner $banner;
    protected Categories $categories;
    protected Offer $offer;
    public function __construct()
    {
        $this->slider = new Slider();
        $this->product = new Product();
        $this->banner = new Banner();
        $this->categories = new Categories();
        $this->offer = new Offer();
    }
    public function index()
    {
        $data['sliders'] = $this->slider->findAll();
        $data['featureds'] = $this->product->where("status",true)->where("featured",true)->findAll();
        $data['news'] = $this->product->where("status",true)->where("new_label",true)->findAll();
        $data['banner_bottom_slider'] = $this->banner->where("banner_location","BOTTOM_SLIDER")->findAll();
        $data['banner_long_banner'] = $this->banner->where("banner_location","LONG_BANNER")->findAll();
        $data['banner_bottom_offer'] = $this->banner->where("banner_location","BOTTOM_OFFER")->findAll();
        list($category1,$item1) = $this->getRandomProductByCategory();
        list($category2,$item2) = $this->getRandomProductByCategory();
        list($category3,$item3) = $this->getRandomProductByCategory();
        $data['ct1_name'] = $category1;
        $data['ct1_items'] = $item1;
        $data['ct2_name'] = $category2;
        $data['ct2_items'] = $item2;
        $data['ct3_name'] = $category3;
        $data['ct3_items'] = $item3;
        $data['offers'] = $this->get_offers_($this->product->with("offers")->findAll());
        return view('client/home_view',add_data("Welcome Back","home/index",$data));
    }
    

    public function get_offers_($productOffer)
    {
        $expired = date("Y-m-d H:i:s");
        $filter = array_filter($productOffer,function($v) use($expired){
            return $v->offers != null && $v->offers[0]->offer_end >= $expired && $v->offers[0]->offer_start <= $expired;;
        });
        return array_values($filter);
    }
    protected function getRandomProductByCategory()
    {
        $randomCategory = $this->categories->without("products")->orderBy("rand()")->first();
        if(count($this->product->where("category_id",$randomCategory->category_id)->findAll())==0){
            return $this->getRandomProductByCategory();
        }
        return array_values(['category'=>$randomCategory->category,"items"=> $this->product->with("product_discount")->where("category_id",$randomCategory->category_id)->where("status",1)->limit(10)->findAll()]);
    }
    
}

