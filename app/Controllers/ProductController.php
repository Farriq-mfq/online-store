<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\SessionCart;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductInventories;
use App\Models\ShoppingCart;
use Config\Services;

class ProductController extends BaseController
{
    private Product $products;
    private Categories $categories;
    private ShoppingCart $shoppingcart;
    private ProductInventories $productInventories;
    private ProductImages $productImages;
    public function __construct()
    {
        $this->products = new Product();
        $this->categories = new Categories();
        $this->shoppingcart = new ShoppingCart();
        $this->productInventories = new ProductInventories();
        $this->productImages = new ProductImages();
    }
    public function index()
    {
        $data['products'] = $this->products->with("product_images")->where("status",true)->paginate(6,"product");
        $data['categories'] = $this->categories->getCategoriesByParentId();
        return view('client/shop/index',add_data("All Products","product/index",$data));
    }
    public function detail($slug)
    {
        try{
            $product = $this->products->with("product_images")->where("slug",$slug)->first();
            $data['product'] = $product;
            $data['availible_stock'] = $this->products->checkAvailableStock($product->product_id);
            return view('client/shop/detail',add_data("Product Detail","product/detail",$data));
        }catch(\Exception $e){
            return redirect()->to(base_url('/product'));
        }
    }

    public function add_to_cart()
    {
        if($this->request->isAJAX()){
            header('Content-Type: application/json');
            $validate = $this->validate([
                "product_id"=>"required|numeric",
                "qty"=>"required|numeric",
            ]);
            if($validate){
                $user_id = Services::authserviceUser()->getSessionData()['user_id'];
                $product_id = htmlentities($this->request->getPost("product_id"));
                if($this->request->getPost("product_inventories_id")){
                    $product_inventories_id = htmlentities($this->request->getPost("product_inventories_id"));
                    $price = $this->productInventories->find($product_inventories_id)->price;
                    $checkCartIsadded = $this->shoppingcart->where("user_id",$user_id)->where("product_id",$product_id)->where("product_inventories_id",$product_inventories_id)->first();
                }else{
                    $price = $this->products->find($product_id)->price;
                    $product_inventories_id = null;
                    $checkCartIsadded = $this->shoppingcart->where("user_id",$user_id)->where("product_id",$product_id)->where("product_inventories_id",NULL)->first();
                }
                $qty = $this->request->getPost("qty");

                $data = [
                    "user_id"=>$user_id,
                    "product_id"=>$product_id,
                    "product_inventories_id"=>$product_inventories_id,
                    "quantity"=>$qty,
                    "price"=> (int) $price,
                    "total"=> (int) $price * $qty,
                    "product_img"=> $this->productImages->where("product_id",$product_id)->first()->image
                ];
                if($checkCartIsadded==null){
                    $this->shoppingcart->insert($data);
                }else{
                    $new_qty = $checkCartIsadded->quantity+1;
                    $new_total = $new_qty * $price;
                    $this->shoppingcart->update($checkCartIsadded->session_cart_id,["quantity"=>$new_qty,"total"=>$new_total]);
                }
                http_response_code(200);
                return json_encode(["success"=>"Success Add to cart"]);
            }else{
                http_response_code(400);
                return json_encode(["error"=>$this->validator->getErrors()]);
            }
        }
    }

    public function getCountCart()
    {
        if($this->request->isAJAX()){
            http_response_code(200);
            header('Content-Type: application/json');
            $count = $this->shoppingcart->where("user_id",Services::authserviceUser()->getSessionData()['user_id'])->countAllResults();
            return json_encode(["count"=>$count]);
        }
    }
}
