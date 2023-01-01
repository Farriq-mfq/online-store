<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reset;
use App\Models\User;
use Config\Services;

class AuthController extends BaseController
{
    private User $user;
    private Reset $reset;
    public function __construct()
    {
        $this->user = new User();
        $this->reset = new Reset();
    }
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
        $checkEmail = $this->user->where('email', $this->request->getVar('email'))->first();
        if ($checkEmail != null) {
            if ($checkEmail->email_verification != '0') {
                if (Services::authserviceUser()->attempt($credentials)) {
                    return redirect()->to(base_url("/shop"));
                } else {
                    session()->setFlashdata('error_login', "Invalid email or password");
                    return redirect()->to(base_url('/auth'));
                }
            } else {
                session()->setFlashdata('not_verif', $checkEmail->user_id);
                session()->setFlashdata('error_login', "Your Email Not Confirmation");
                return redirect()->to(base_url('/auth'));
            }
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
                'rules' => "required|valid_email|is_unique[users.email]",
                'errors' => [
                    'required' => 'The email field is required.',
                    'valid_email' => 'The email must be email',
                    'is_unique' => "This Email already Registred",
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
                'password' => password_hash($this->request->getVar('password_register'), PASSWORD_DEFAULT),
            ];
            $register = $this->user->insert($register_data);
            if ($register) {
                $user = $this->user->find($register);
                if ($user != null) {
                    $code = uniqid() . $user->user_id . rand(0, 1000);
                    $date = date_create(date("Y-m-d H:i:s"));
                    date_add($date, date_interval_create_from_date_string("1 days"));
                    $data = [
                        'code' => $code,
                        'expired' => date_format($date, "Y-m-d H:i:s"),
                        'type' => "CONFIRM_EMAIL_USER",
                        'user_id' => $user->user_id
                    ];
                    $checkResetifexist = $this->reset->where('user_id', $user->user_id)->where('type', "CONFIRM_EMAIL_USER")->first();
                    if ($checkResetifexist == null) {
                        $insert_id = $this->reset->insert($data);
                        $reset = $this->reset->find($insert_id);
                        if ($reset != null) {
                            if ($this->mail->sendEmailRegister(base_url('auth/email/verification?code=' . randomhash($code)), $user->email, $user->name)) {
                                session()->setFlashdata('alert_success', "Register SuccessFully :)");
                                return redirect()->to('/auth');
                            } else {
                                session()->setFlashdata('alert_error', "Register Failed :(");
                                return redirect()->to('/auth');
                            }
                        } else {
                            session()->setFlashdata('alert_error', "Register Failed :(");
                            return redirect()->to('/auth');
                        }
                    } else {
                        session()->setFlashdata('alert_error', "Register Failed :(");
                        return redirect()->to('/auth');
                    }
                }
            } else {
                session()->setFlashdata('alert_error', "Register Failed :(");
                return redirect()->to('/auth');
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to(base_url('/auth'))->withInput();
        }
    }

    public function resetPassword()
    {
        return view("client/auth/reset", add_data("Password reset", ""));
    }
    public function resetPasswordSend()
    {
        $validate = $this->validate(['email' => 'required|valid_email']);
        if ($validate) {
            $checkEmail = $this->user->where('email', $this->request->getVar('email'))->first();
            if ($checkEmail != null) {
                $code = uniqid() . $checkEmail->user_id . rand(0, 1000);
                $date = date_create(date("Y-m-d H:i:s"));
                date_add($date, date_interval_create_from_date_string("1 days"));
                $data = [
                    'code' => $code,
                    'expired' => date_format($date, "Y-m-d H:i:s"),
                    'type' => "RESET_PASSWORD_USER",
                    'user_id' => $checkEmail->user_id
                ];
                $checkResetifexist = $this->reset->where('user_id', $checkEmail->user_id)->where('type', "RESET_PASSWORD_USER")->first();
                if ($checkResetifexist == null) {
                    $insert_id = $this->reset->insert($data);
                    $reset = $this->reset->find($insert_id);
                    if ($reset != null) {
                        if ($this->mail->sendResetlink($checkEmail->email, base_url('auth/verification?code=' . randomhash($reset->code)))) {
                            session()->setFlashdata('alert_success', "Failed reset password :)");
                            return redirect()->to(base_url('auth/reset'));
                        } else {
                            session()->setFlashdata('alert_error', "SuccessFully send link to reset password :)");
                            return redirect()->to(base_url('auth/reset'));
                        }
                    } else {
                        session()->setFlashdata('alert_error', "Failed reset password");
                        return redirect()->to(base_url('auth/reset'));
                    }
                } else {
                    session()->setFlashdata('alert_success', "Reset link has been sent");
                    return redirect()->to(base_url('auth/reset'));
                }
            } else {
                session()->setFlashdata('validation', ['email' => 'Email not register']);
                return redirect()->to(base_url('auth/reset'));
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to(base_url('auth/reset'));
        }
    }
    public function verif()
    {
        if ($this->request->getVar('code')) {
            $code = htmlentities($this->request->getVar('code'));
            $current_date = date('Y-m-d H:i:s');
            $enc = Services::encrypter();
            $dec_code = $enc->decrypt(hex2bin($code));
            $reset = $this->reset->where('code', $dec_code)->first();
            if ($reset != null) {
                if ($current_date > $reset->expired) {
                    session()->setFlashdata('alert_error', "Link expired");
                    return redirect()->back();
                } else {
                    $data['code'] = $code;
                    return view('client/auth/change', add_data('Change Password', '', $data));
                }
            } else {
                session()->setFlashdata('alert_error', "Link expired");
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function email_verif()
    {
        if ($this->request->getVar('code')) {
            $code = htmlentities($this->request->getVar('code'));
            $current_date = date('Y-m-d H:i:s');
            $enc = Services::encrypter();
            $dec_code = $enc->decrypt(hex2bin($code));
            $reset = $this->reset->where('code', $dec_code)->first();
            if ($reset != null) {
                if ($current_date > $reset->expired) {
                    session()->setFlashdata('alert_error', "Link expired");
                    return redirect()->back();
                } else {
                    $user = $this->user->find($reset->user_id);

                    if ($user != null) {
                        if ($user->email_verification == "0") {
                            $update = $this->user->update($reset->user_id, ['email_verification' => true]);
                            if ($update) {
                                $this->reset->delete($reset->reset_id);
                                session()->setFlashdata('alert_success', "Email Verification Success");
                                return redirect()->to("/auth");
                            }
                        } else {
                            session()->setFlashdata('alert_error', "Verification Failed");
                            return redirect()->back();
                        }
                    } else {
                        session()->setFlashdata('alert_error', "Verification Failed");
                        return redirect()->back();
                    }
                }
            } else {
                session()->setFlashdata('alert_error', "Link expired");
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function change_password($code)
    {
        $validate = $this->validate([
            "password" => [
                'rules' => "required|min_length[5]",
                'errors' => [
                    'required' => "The email field is required.",
                    'min_length' => 'The password field must be at least 5 characters in length.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => "confirm password must be the same as password."
                ]
            ]
        ]);

        if ($validate) {
            $code = htmlentities($code);
            $enc = Services::encrypter();
            $dec_code = $enc->decrypt(hex2bin($code));
            $reset = $this->reset->where('code', $dec_code)->first();
            if ($reset != null) {
                $data = [
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];
                $update = $this->user->update($reset->user_id, $data);
                if ($update) {
                    session()->setFlashdata('alert_success', "update password SuccessFully :)");
                    $this->reset->delete($reset->reset_id);
                    return redirect()->to("auth");
                } else {
                    session()->setFlashdata('alert_error', "update password Failed :(");
                    return redirect()->back();
                }
            } else {
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back();
        }
    }

    public function resend_email_confirmation($id)
    {
        $checkreset_link = $this->reset->where('user_id', $id)->where("type", "CONFIRM_EMAIL_USER")->first();
        $code = uniqid() . $id . rand(0, 1000);
        $date = date_create(date("Y-m-d H:i:s"));
        date_add($date, date_interval_create_from_date_string("1 days"));
        $data = [
            'code' => $code,
            'expired' => date_format($date, "Y-m-d H:i:s"),
            'type' => "CONFIRM_EMAIL_USER",
            'user_id' => $id
        ];
        $user = $this->user->find($id);
        $current_date = date('Y-m-d H:i:s');
        if ($checkreset_link == null) {
            $insert_id = $this->reset->insert($data);
            $reset = $this->reset->find($insert_id);
            if ($reset != null) {
                if ($this->mail->sendEmailRegister(base_url('auth/email/verification?code=' . randomhash($code)), $user->email, $user->name)) {
                    session()->setFlashdata('alert_success', "Resend SuccessFully :)");
                    return redirect()->to('/auth');
                } else {
                    session()->setFlashdata('alert_error', "Resend Failed :(");
                    return redirect()->to('/auth');
                }
            } else {
                session()->setFlashdata('alert_error', "Resend Failed :(");
                return redirect()->to('/auth');
            }
        } else {
            if ($current_date > $checkreset_link->expired) {
                $this->reset->delete($checkreset_link->reset_id);
                $insert_id = $this->reset->insert($data);
                $reset = $this->reset->find($insert_id);
                if ($reset != null) {
                    if ($this->mail->sendEmailRegister(base_url('auth/email/verification?code=' . randomhash($code)), $user->email, $user->name)) {
                        session()->setFlashdata('alert_success', "Resend SuccessFully :)");
                        return redirect()->to('/auth');
                    } else {
                        session()->setFlashdata('alert_error', "Resend Failed :(");
                        return redirect()->to('/auth');
                    }
                } else {
                    session()->setFlashdata('alert_error', "Resend Failed :(");
                    return redirect()->to('/auth');
                }
                return redirect()->back();
            } else {
                if ($this->mail->sendEmailRegister(base_url('auth/email/verification?code=' . randomhash($checkreset_link->code)), $user->email, $user->name)) {
                    session()->setFlashdata('alert_success', "Resend SuccessFully :)");
                    return redirect()->to('/auth');
                } else {
                    session()->setFlashdata('alert_error', "Resend Failed :(");
                    return redirect()->to('/auth');
                }
            }
        }
    }
}
