<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\Slider;

class SliderController extends BaseController
{
    private Product $product;
    private Slider $slider;
    public function __construct()
    {
        $this->product = new Product();
        $this->slider = new Slider();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_images")->find();
        return view("admin/sliders/index", add_data("Sliders", "slider/index", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            header('Content-Type: application/json');
            $images = $this->productImages->find((int)esc($this->request->getVar("id")));
            return json_encode($images);
        }
    }
    public function store()
    {
        $validate = $this->validate([
            "title" => "required|max_length[50]",
            "subtitle" => "required|max_length[50]",
            "subtitlecolor" => "required|max_length[50]",
            "short_description" => "required",
            "link_label" => "required|max_length[20]",
            "link" => "required|max_length[150]",
            "image" => [
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
                "errors" => [
                    "uploaded" => "Please Put Image",
                    "is_image" => "Your File is not an image",
                    "mime_in" => "Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size" => "File size is only 2mb"
                ]
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $name = $this->request->getFile("image")->getRandomName();
        $data = [
            "image" => base_url("/uploads/sliders/" . $name),
            "title" => $this->request->getVar("title"),
            "subtitle" => $this->request->getVar("subtitle"),
            "subtitlecolor" => $this->request->getVar("subtitlecolor"),
            "short_description" => $this->request->getVar("short_description"),
            "link_label" => $this->request->getVar("link_label"),
            "link" => $this->request->getVar("link"),
        ];

        if (filter_var($this->request->getVar("link"), FILTER_VALIDATE_URL)) {
            list($width, $height) = getimagesize($this->request->getFile("image")); // dimension harus  width 770 dan height 494
            if ($width = 770 && $height = 494) {
                if ($this->slider->insert($data)) {
                    $this->request->getFile("image")->move("uploads/sliders", $name);
                    alert("Success Add Slider", "success");
                }else{
                    session()->setFlashdata("validation", ["image" => "Invalid dimension of image"]);
                    return redirect()->back()->withInput();
                }
            }
        } else {
            session()->setFlashdata("validation", ["link" => "Invalid Link url"]);
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
    // public function update($id)
    // {
    //     $validate = $this->validate([
    //         "image" => [
    //             'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]',
    //             "errors" => [
    //                 "uploaded" => "Please Put Image",
    //                 "is_image" => "Your File is not an image",
    //                 "mime_in" => "Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
    //                 "max_size" => "File size is only 2mb"
    //             ]
    //         ],
    //     ]);

    //     if (!$validate) {
    //         session()->setFlashdata("validation", $this->validator->getErrors());
    //         session()->setFlashdata("action_session_images", admin_url("/product/images/" . $id));
    //         return redirect()->back()->withInput();
    //     }
    //     $name = $this->request->getFile("image")->getRandomName();
    //     $data = [
    //         "image" => base_url("/uploads/products/" . $name),
    //         "mime" => $this->request->getFile("image")->getMimeType(),
    //         "name" => $name,
    //     ];
    //     $image = $this->productImages->find($id);
    //     $path = PUBLIC_PATH . "/uploads/products/" . $image->name;
    //     if (file_exists($path)) {
    //         unlink($path);
    //     }
    //     if ($this->productImages->update($id, $data)) {
    //         $this->request->getFile("image")->move("uploads/products", $name);
    //         alert("Success Update Images", "success");
    //     }
    //     return redirect()->back();
    // }
    // public function remove($id)
    // {
    //     try {
    //         $image = $this->productImages->find($id);
    //         if ($image->is_primary) {
    //             alert("Primary Image can't delete", "error");
    //         } else {
    //             $path = PUBLIC_PATH . "/uploads/products/" . $image->name;
    //             if (file_exists($path)) {
    //                 unlink($path);
    //             }
    //             $this->productImages->delete($id);
    //             alert("Success delete Images", "success");
    //         }
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         alert("Internal Server error", "error");
    //     }
    // }
    // public function is_primary($id)
    // {
    //     try {
    //         $image = $this->productImages->find($id);
    //         if ($this->productImages->update_is_primary($image->product_id)) {
    //             $this->productImages->update($id, ["is_primary" => true]);
    //             alert("Success Update Primary Images", "success");
    //         } else {
    //             alert("Failed", "error");
    //         }
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         alert("Internal Server error", "error");
    //     }
    // }
}
