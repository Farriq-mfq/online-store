<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Banner;
use App\Models\Slider;

class BannerController extends BaseController
{
    private Banner $banner;
    public function __construct()
    {
        $this->banner = new Banner();
    }
    public function index()
    {
        $data['banners'] = $this->banner->findAll();
        return view("admin/banner/index", add_data("Banners", "banner/index", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $banner = $this->banner->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($banner);
        }
    }
    public function store()
    {
        $validate = $this->validate([
            "banner_location" => "required",
            "title" => "max_length[150]",
            "paragraph" => "max_length[200]",
            "link_label" => "max_length[20]",
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
            "image" => base_url("/uploads/banners/" . $name),
            "image_name" => $name,
            "title" => $this->request->getVar("title"),
            "banner_location" => $this->request->getVar("banner_location"),
            "subtitle_color" => $this->request->getVar("subtitlecolor"),
            "paragraph" => $this->request->getVar("paragraph"),
            "link_label" => $this->request->getVar("link_label"),
            "link" => $this->request->getVar("link"),
        ];

        $banner = $this->banner->where("banner_location", $this->request->getVar("banner_location"))->findAll();
        if ($this->checkBannerCount($this->request->getVar("banner_location"), count($banner))) {
            if (filter_var($this->request->getVar("link"), FILTER_VALIDATE_URL)) {
                list($width, $height) = getimagesize($this->request->getFile("image"));
                if ($this->validateDimension($this->request->getVar("banner_location"), $width, $height)) {
                    if ($this->banner->insert($data)) {
                        $this->request->getFile("image")->move("uploads/banners", $name);
                        alert("Success Add Banner", "success");
                    }
                } else {
                    session()->setFlashdata("validation", ["image" => "Invalid Image dimension"]);
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata("validation", ["link" => "Invalid Link url"]);
                return redirect()->back()->withInput();
            }
        }else{
            alert($this->request->getVar("banner_location")." Already set",'error');
        }
        return redirect()->back();
    }

    protected function checkBannerCount(string $type, int $count)
    {
        switch ($type) {
            case 'BOTTOM_SLIDER':
                if ($count >= 4) {
                    return false;
                } else {
                    return true;
                }
            case 'BOTTOM_OFFER':
                if ($count >= 2) {
                    return false;
                } else {
                    return true;
                }

            case 'LONG_BANNER':
                if ($count >= 2) {
                    return false;
                } else {
                    return true;
                }
            default:
                return false;
        }
    }
    protected function validateDimension(string $type, int $width, int $height): bool
    {
        switch ($type) {
            case 'BOTTOM_SLIDER':
                if ($width == 570 && $height == 169 || $width == 570 && $height >= 169) {
                    return true;
                } else {
                    return false;
                }
            case 'BOTTOM_OFFER':
                if ($width == 370 && $height == 158 || $width == 370 && $height >= 158) {
                    return true;
                } else {
                    return false;
                }
            case 'LONG_BANNER':
                if ($width == 1170 && $height == 239 || $width == 1170 && $height >= 239) {
                    return true;
                } else {
                    return false;
                }
            default:
                return false;
        }
    }
    public function update()
    {
        $rules = !empty($this->request->getFile("image")->getName()) ?  [
            "title" => "max_length[150]",
            "paragraph" => "max_length[200]",
            "link_label" => "max_length[20]",
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

            "title" => "max_length[150]",
            "paragraph" => "max_length[200]",
            "link_label" => "max_length[20]",
            "link" => "required|max_length[150]",
        ];
        $validate = $this->validate($rules);

        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("banner_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $id = (int)esc($this->request->getVar("banner_id"));
        if (!empty($this->request->getFile("image")->getName())) {
            $name = $this->request->getFile("image")->getRandomName();
            $data = [
                "image" => base_url("/uploads/banners/" . $name),
                "image_name" => $name,
                "title" => $this->request->getVar("title"),
                "subtitle_color" => $this->request->getVar("subtitlecolor"),
                "paragraph" => $this->request->getVar("paragraph"),
                "link_label" => $this->request->getVar("link_label"),
                "link" => $this->request->getVar("link"),
            ];
        } else {
            $data = [
                "title" => $this->request->getVar("title"),
                "subtitle_color" => $this->request->getVar("subtitlecolor"),
                "paragraph" => $this->request->getVar("paragraph"),
                "link_label" => $this->request->getVar("link_label"),
                "link" => $this->request->getVar("link"),
            ];
        }
        if (filter_var($this->request->getVar("link"), FILTER_VALIDATE_URL)) {
            if (!empty($this->request->getFile("image")->getName())) {
                list($width, $height) = getimagesize($this->request->getFile("image"));
                $banner = $this->banner->find($id);
                if ($this->validateDimension($banner->banner_location, $width, $height)) {
                    if ($banner != null) {
                        $path = PUBLIC_PATH . "/uploads/banners/" . $banner->image_name;
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                    if ($this->banner->update($id, $data)) {
                        $this->request->getFile("image")->move("uploads/banners", $name);
                        alert("Success Update banner", "success");
                    }
                } else {
                    session()->setFlashdata("validation", ["image" => "Invalid Image dimension"]);
                    session()->setFlashdata('update_id', (int)esc($this->request->getVar("banner_id")));
                    return redirect()->back()->withInput();
                }
            } else {
                if ($this->banner->update($id, $data)) {
                    alert("Success Update banner", "success");
                }
            }
        } else {
            session()->setFlashdata("validation", ["link" => "Invalid Link url"]);
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("banner_id")));
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $banner = $this->banner->find($id);
            $path = PUBLIC_PATH . "/uploads/banners/" . $banner->image_name;
            if (file_exists($path)) {
                unlink($path);
            }
            $this->banner->delete($id);
            alert("Success delete Banner", "success");

            return redirect()->back();
        } catch (\Exception $e) {
            alert("Internal Server error", "error");
        }
    }
}
