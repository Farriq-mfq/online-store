<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Slider;


class SliderController extends BaseController
{
    private Slider $slider;
    public function __construct()
    {
        $this->slider = new Slider();
    }
    public function index()
    {
        $data['sliders'] = $this->slider->findAll();
        return view("admin/sliders/index", add_data("Sliders", "slider/index", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $slider = $this->slider->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($slider);
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
            "image_name" => $name,
            "title" => $this->request->getVar("title"),
            "subtitle" => $this->request->getVar("subtitle"),
            "subtitle_color" => $this->request->getVar("subtitlecolor"),
            "short_description" => $this->request->getVar("short_description"),
            "link_label" => $this->request->getVar("link_label"),
            "link" => $this->request->getVar("link"),
        ];

        if (filter_var($this->request->getVar("link"), FILTER_VALIDATE_URL)) {
            list($width, $height) = getimagesize($this->request->getFile("image")); // dimension harus  width 770 dan height 494
            if ($width == 770 && $height == 494) {
                if ($this->slider->insert($data)) {
                    $this->request->getFile("image")->move("uploads/sliders", $name);
                    alert("Success Add Slider", "success");
                }
            } else {
                session()->setFlashdata("validation", ["image" => "Invalid Image dimension"]);
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata("validation", ["link" => "Invalid Link url"]);
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
    public function update()
    {
        $rules = !empty($this->request->getFile("image")->getName()) ?  [
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
        ] : [

            "title" => "required|max_length[50]",
            "subtitle" => "required|max_length[50]",
            "subtitlecolor" => "required|max_length[50]",
            "short_description" => "required",
            "link_label" => "required|max_length[20]",
            "link" => "required|max_length[150]",
        ];
        $validate = $this->validate($rules);

        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("slider_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $id = (int)esc($this->request->getVar("slider_id"));
        if (!empty($this->request->getFile("image")->getName())) {
            $name = $this->request->getFile("image")->getRandomName();
            $data = [
                "image" => base_url("/uploads/sliders/" . $name),
                "image_name" => $name,
                "title" => $this->request->getVar("title"),
                "subtitle" => $this->request->getVar("subtitle"),
                "subtitle_color" => $this->request->getVar("subtitlecolor"),
                "short_description" => $this->request->getVar("short_description"),
                "link_label" => $this->request->getVar("link_label"),
                "link" => $this->request->getVar("link"),
            ];
            $image = $this->slider->find($id);
            $path = PUBLIC_PATH . "/uploads/products/" . $image->image_name;
            if (file_exists($path)) {
                unlink($path);
            }
        } else {
            $data = [
                "title" => $this->request->getVar("title"),
                "subtitle" => $this->request->getVar("subtitle"),
                "subtitle_color" => $this->request->getVar("subtitlecolor"),
                "short_description" => $this->request->getVar("short_description"),
                "link_label" => $this->request->getVar("link_label"),
                "link" => $this->request->getVar("link"),
            ];
        } // dimension harus  width 770 dan height 494
        if (filter_var($this->request->getVar("link"), FILTER_VALIDATE_URL)) {
            if (!empty($this->request->getFile("image")->getName())) {
                list($width, $height) = getimagesize($this->request->getFile("image")); // dimension harus  width 770 dan height 494
                if ($width == 770 && $height == 494) {
                    if ($this->slider->update($id, $data)) {
                        $this->request->getFile("image")->move("uploads/sliders", $name);
                        alert("Success Update Slider", "success");
                    }
                } else {
                    if ($this->slider->update($id, $data)) {

                        alert("Success Update Slider", "success");
                    }
                }
            } else {
                session()->setFlashdata("validation", ["image" => "Invalid Image dimension"]);
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata("validation", ["link" => "Invalid Link url"]);
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $slider = $this->slider->find($id);
            $path = PUBLIC_PATH . "/uploads/sliders/" . $slider->image_name;
            if (file_exists($path)) {
                unlink($path);
            }
            $this->slider->delete($id);
            alert("Success delete Images", "success");

            return redirect()->back();
        } catch (\Exception $e) {
            alert("Internal Server error", "error");
        }
    }
}
