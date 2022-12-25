<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class AuthController extends BaseController
{
    public function index()
    {
        return view("client/auth/index",add_data("Login",""));
    }
    public function login()
    {
        $validate = $this->validate([
            "email"=>[
                'rules'=>"required|valid_email",
            ],
            "password"=>[
                'rules'=>"required",
            ],
        ]);

        if(!$validate){
            session()->setFlashdata('validation',$this->validator->getErrors());
            return redirect()->to(base_url('/auth'))->withInput();
        }

        $credentials = [
            "email"=>$this->request->getVar("email"),
            "password"=>$this->request->getVar("password"),
        ];
        if(Services::authserviceUser()->attempt($credentials)){
            return redirect()->to(base_url("/shop"));
        }else{
            session()->setFlashdata('error_login',"Invalid email or password");
            return redirect()->to(base_url('/auth'));
        }
    }
}
