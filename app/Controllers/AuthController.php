<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        return view("client/auth/index", add_data("Login", ""));
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
            return redirect()->to(base_url('/auth'))->withInput();
        }

        $credentials = [
            "email" => $this->request->getVar("email"),
            "password" => $this->request->getVar("password"),
        ];
        if (Services::authserviceUser()->attempt($credentials)) {
            return redirect()->to(base_url("/shop"));
        } else {
            session()->setFlashdata('error_login', "Invalid email or password");
            return redirect()->to(base_url('/auth'));
        }
    }
    public function logout()
    {
        Services::authserviceUser()->logout();
        return redirect()->to('/auth');
    }
    public function register()
    {
        $validate = $this->validate([
            "name" => [
                'rules' => "required|min_length[5]",
            ],
            "email_register" => [
                'rules' => "required|valid_email",
                'errors' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email must be email'
                ]
            ],
            "password_register" => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => "The email field is required.",
                    'min_length' => 'The password field must be at least 5 characters in length.'
                ]
            ],
            'confirm' => [
                'rules' => 'required|matches[password_register]',
                'errors' => [
                    'matches' => "confirm password must be the same as password."
                ]
            ]
        ]);

        if ($validate) {
            $register_data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email_register'),
                'password' => $this->request->getVar('password_register'),
            ];
            $register = Services::authserviceUser()->register($register_data);
            if ($register) {
                session()->setFlashdata('alert_success', "Register SuccessFully :)");
                return redirect()->to('/auth');
            } else {
                session()->setFlashdata('alert_error', "Register Failed :(");
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to(base_url('/auth'))->withInput();
        }
    }
}
