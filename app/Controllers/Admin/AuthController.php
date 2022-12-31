<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        return view("admin/auth/index", add_data('Login', 'login/index'));
    }
    public function login()
    {
        $validate = $this->validate([
            "email" => [
                'rules' => "required|valid_email",
            ],
            "password" => [
                'rules' => "required",
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to(admin_url('/auth/login'))->withInput();
        }

        $credentials = [
            "email" => $this->request->getVar("email"),
            "password" => $this->request->getVar("password"),
        ];
        if (Services::authserviceAdmin()->attempt($credentials)) {
            return redirect()->to(admin_url("/"));
        } else {
            session()->setFlashdata('error_login', "Invalid email or password");
            return redirect()->to(admin_url('/auth/login'));
        }
    }
    public function logout()
    {
        Services::authserviceAdmin()->logout();
        return redirect()->to(admin_url('/auth/login'));
    }
}
