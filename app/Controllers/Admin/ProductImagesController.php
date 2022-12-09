<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductImages;
class ProductImagesController extends BaseController
{
    private Product $product;
    private ProductImages $productImages;
    public function __construct()
    {
        $this->product = new Product();
        $this->productImages = new ProductImages();
    }
    public function index()
    {
        $data['products'] =$this->product->with("product_images")->find();
        return view("admin/product/images/index",add_data("Images Product","product/images",$data));
    }
    public function edit()
    {
        if($this->request->isAjax()){
            header('Content-Type: application/json');
            $images = $this->productImages->find((int)esc($this->request->getVar("id")));
            return json_encode($images);
        }
    }
    public function store($productID)
    {
        $validate = $this->validate([
            "image"=>[
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
                "errors"=>[
                    "uploaded"=>"Please Put Image",
                    "is_image"=>"Your File is not an image",
                    "mime_in"=>"Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size"=>"File size is only 2mb"
                ]
            ],
        ]);

        if(!$validate){
            session()->setFlashdata("validation",$this->validator->getErrors());
            session()->setFlashdata("action_session_images",admin_url("/product/images/".$productID));
            return redirect()->back()->withInput();
        }
        $name = $this->request->getFile("image")->getRandomName();
        $data = [
            "image"=>base_url("/uploads/products/".$name),
            "mime"=>$this->request->getFile("image")->getMimeType(),
            "name"=>$name,
            "product_id"=>$productID
        ];

        if($this->productImages->insert($data)){
            $this->request->getFile("image")->move("uploads/products",$name);
            alert("Success Add Images","success"); 
        }
        return redirect()->back();
    }
    public function update($id)
    {
        $validate = $this->validate([
            "image"=>[
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
                "errors"=>[
                    "uploaded"=>"Please Put Image",
                    "is_image"=>"Your File is not an image",
                    "mime_in"=>"Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size"=>"File size is only 2mb"
                ]
            ],
        ]);

        if(!$validate){
            session()->setFlashdata("validation",$this->validator->getErrors());
            session()->setFlashdata("action_session_images",admin_url("/product/images/".$id));
            return redirect()->back()->withInput();
        }
        $name = $this->request->getFile("image")->getRandomName();
        $data = [
            "image"=>base_url("/uploads/products/".$name),
            "mime"=>$this->request->getFile("image")->getMimeType(),
            "name"=>$name,
        ];
        $image = $this->productImages->find($id);
        $path = PUBLIC_PATH."/uploads/products/".$image->name;
        if(file_exists($path)){
            unlink($path);
        }
        if($this->productImages->update($id,$data)){
            $this->request->getFile("image")->move("uploads/products",$name);
            alert("Success Update Images","success"); 
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try{
            $image = $this->productImages->find($id);
            if($image->is_primary){
                alert("Primary Image can't delete","error"); 
            }else{
                $path = PUBLIC_PATH."/uploads/products/".$image->name;
                if(file_exists($path)){
                    unlink($path);
                }
                $this->productImages->delete($id);
                alert("Success delete Images","success"); 
            }
            return redirect()->back();
        }catch(\Exception $e){
            alert("Internal Server error","error"); 
        }
    }
    public function is_primary($id)
    {
        try{
            $image = $this->productImages->find($id);
            if($this->productImages->update_is_primary($image->product_id)){
                $this->productImages->update($id,["is_primary"=>true]);
                alert("Success Update Primary Images","success"); 
            }else{
                alert("Failed","error"); 
            }
            return redirect()->back();
        }catch(\Exception $e){
            alert("Internal Server error","error"); 
        }
    }
}
