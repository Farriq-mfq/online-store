<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Website;

class WebsiteController extends BaseController
{
    private Website $website;
    public function __construct()
    {
        $this->website = new Website();
    }
    public function index()
    {
        $data['website'] = $this->website->first();
        $data['city'] = $this->shipping->get_city();
        return view('admin/website/index', add_data('Website Settings', 'website/index', $data));
    }
    public function change()
    {
        $validate = $this->website->first() != null ? [
            'title_separator' => 'required|max_length[50]',
            "logo" => [
                'rules' => 'is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]|max_size[logo,2048]',
                "errors" => [
                    "uploaded" => "Please Put Image",
                    "is_image" => "Your File is not an image",
                    "mime_in" => "Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size" => "File size is only 2mb"
                ]
            ],
            "favicon" => [
                'rules' => 'is_image[favicon]|max_size[favicon,2048]',
                "errors" => [
                    "uploaded" => "Please Put Image",
                    "is_image" => "Your File is not an image",
                    "mime_in" => "Invalid extension with image/x-icon",
                    "max_size" => "File size is only 2mb"
                ]
            ],
            'support_content' => 'required',
            'footer_content' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required|numeric',
            'company_email' => 'required|valid_email',
            'shipping_origin' => 'required'
        ] : [
            'title_separator' => 'required|max_length[50]',
            "logo" => [
                'rules' => 'uploaded[logo]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]|max_size[logo,2048]',
                "errors" => [
                    "uploaded" => "Please Put Image",
                    "is_image" => "Your File is not an image",
                    "mime_in" => "Invalid extension with image/jpg,image/jpeg,image/gif,image/png",
                    "max_size" => "File size is only 2mb"
                ]
            ],
            "favicon" => [
                'rules' => 'uploaded[favicon]|is_image[favicon]|max_size[favicon,2048]',
                "errors" => [
                    "uploaded" => "Please Put Image",
                    "is_image" => "Your File is not an image",
                    "mime_in" => "Invalid extension with image/x-icon",
                    "max_size" => "File size is only 2mb"
                ]
            ],
            'support_content' => 'required',
            'footer_content' => 'required',
            'company_address' => 'required',
            'company_phone' => 'required|numeric',
            'company_email' => 'required|valid_email',
            'shipping_origin' => 'required'
        ];

        if ($this->validate($validate)) {
            if ($this->website->first() != null) {
                $data = [
                    'title_separator' => $this->request->getVar('title_separator'),
                    'support_content' => htmlentities($this->request->getVar('support_content')),
                    'footer_content' => htmlentities($this->request->getVar('footer_content')),
                    'company_address' => $this->request->getVar('company_address'),
                    'company_phone' => $this->request->getVar('company_phone'),
                    'company_email' => $this->request->getVar('company_email'),
                    'shipping_origin' => $this->request->getVar('shipping_origin'),
                    'information_content' => htmlentities($this->request->getVar('information_content')),
                    'extras_content' => htmlentities($this->request->getVar('extras_content')),

                ];
                if ($this->request->getFile('logo')->getError() != 4) {
                    $logo = $this->request->getFile('logo')->getRandomName();
                    $data = array_merge($data, ['logo' => base_url("/uploads/website/" . $logo), "logo_name" => $logo,]);
                }
                if ($this->request->getFile('favicon')->getError() != 4) {
                    $favicon = $this->request->getFile('favicon')->getRandomName();
                    $data = array_merge($data, ['favicon' => base_url("/uploads/website/" . $favicon), "favicon_name" => $favicon,]);
                }
                $website = $this->website->first();
                $logo_path = PUBLIC_PATH . "/uploads/website/" . $website->logo_name;
                $fav_path = PUBLIC_PATH . "/uploads/website/" . $website->favicon_name;
                if ($this->request->getFile('logo')->getError() != 4) {
                    if (file_exists($logo_path)) {
                        unlink($logo_path);
                    }
                }
                if ($this->request->getFile('favicon')->getError() != 4) {
                    if (file_exists($fav_path)) {
                        unlink($fav_path);
                    }
                }
                $update = $this->website->update(null, $data);
                if ($update) {
                    if ($this->request->getFile('logo')->getError() != 4) {
                        $this->request->getFile('logo')->move("uploads/website", $logo);
                    }
                    if ($this->request->getFile('favicon')->getError() != 4) {
                        $this->request->getFile('favicon')->move("uploads/website", $favicon);
                    }
                }
                alert("Success update setting website", 'success');
                return redirect()->back();
            } else {
                $logo = $this->request->getFile('logo')->getRandomName();
                $favicon = $this->request->getFile('favicon')->getRandomName();
                $data = [
                    'title_separator' => $this->request->getVar('title_separator'),
                    'logo' => base_url("/uploads/website/" . $logo),
                    'favicon' => base_url("/uploads/website/" . $favicon),
                    'support_content' => htmlentities($this->request->getVar('support_content')),
                    'footer_content' => htmlentities($this->request->getVar('footer_content')),
                    'company_address' => $this->request->getVar('company_address'),
                    'company_phone' => $this->request->getVar('company_phone'),
                    'company_email' => $this->request->getVar('company_email'),
                    'shipping_origin' => $this->request->getVar('shipping_origin'),
                    'information_content' => htmlentities($this->request->getVar('information_content')),
                    'extras_content' => htmlentities($this->request->getVar('extras_content')),
                    "logo_name" => $logo,
                    "favicon_name" => $favicon
                ];
                $this->website->insert($data);
                $this->request->getFile('logo')->move("uploads/website", $logo);
                $this->request->getFile('favicon')->move("uploads/website", $favicon);
                alert("Success add setting website", 'success');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back();
        }
    }
}
