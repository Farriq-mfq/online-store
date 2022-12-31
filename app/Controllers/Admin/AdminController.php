<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Roles;
use Config\Services;

class AdminController extends BaseController
{
    private Admin $admin;
    private Roles $roles;
    public function __construct()
    {
        $this->admin = new Admin();
        $this->roles = new Roles();
    }
    public function index()
    {
        $data['routes'] = Services::routes()->getRoutes();
        $data['admins'] = $this->admin->where('role', 'ADMIN')->findAll();
        return view('admin/list/index', add_data("List Admin", "list/admin/index", $data));
    }
    public function create()
    {
        $validate = $this->validate([
            "name" => [
                'rules' => "required|min_length[5]",
            ],
            "email" => [
                'rules' => "required|valid_email|is_unique[admin.email]",
            ],
            "password" => [
                'rules' => "required|min_length[5]",
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => "Confirm password is Required",
                    'matches' => "confirm password must be the same as password."
                ]
            ]
        ]);

        if ($validate) {
            $register_data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $register = Services::authserviceAdmin()->register($register_data, 'admin');
            if ($register) {
                alert("Register SuccessFully :)", 'success');
                return redirect()->back();
            } else {
                alert("Register Failed :(", 'error');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
    }
    public function remove($id)
    {
        try {
            $id = htmlentities($id);
            $this->admin->delete($id);
            alert("Delete Admin SuccessFully :)", 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            alert("Delete Admin Failed :(", 'error');
            return redirect()->back();
        }
    }

    public function get_update_admin()
    {
        if ($this->request->isAJAX()) {
            $admin = $this->admin->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($admin);
        }
    }
    public function update()
    {
        $id = (int)esc($this->request->getVar("admin_id"));
        $original = $this->admin->without('roles')->select("email")->find($id);
        if ($this->request->getVar('email') == $original->email) {
            $unique = "";
        } else {
            $unique = "|is_unique[admin.email]";
        }

        $rules = !empty($this->request->getVar('password')) ? [
            "name" => [
                'rules' => "required|min_length[5]",
            ],
            "email" => [
                'rules' => "required|valid_email" . $unique,
            ],
            "password" => [
                'rules' => "min_length[5]",
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => "Confirm password is Required",
                    'matches' => "confirm password must be the same as password."
                ]
            ]
        ] : [
            "name" => [
                'rules' => "required|min_length[5]",
            ],
            "email" => [
                'rules' => "required|valid_email" . $unique,
            ],
            'confirm_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'required' => "Confirm password is Required",
                    'matches' => "confirm password must be the same as password."
                ]
            ]
        ];
        $validate = $this->validate($rules);
        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("admin_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
            return redirect()->back()->withInput();
        } else {
            try {
                alert("Success update admin", "success");
                if (!empty($this->request->getVar('password'))) {
                    $this->admin->update($id, [
                        'name' => $this->request->getVar('name'),
                        'email' => $this->request->getVar('email'),
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                    ]);
                } else {
                    $this->admin->update($id, [
                        'name' => $this->request->getVar('name'),
                        'email' => $this->request->getVar('email'),
                    ]);
                }
                return redirect()->back();
            } catch (\Exception $e) {
                alert("Internal Server error", "error");
                return redirect()->back();
            }
        }
    }
    public function add_roles($id)
    {
        if ($this->validate(['role' => 'required'])) {
            $check = $this->roles->where('admin_id', $id)->where('role', $this->request->getVar('role'))->first();
            if ($check == null) {
                $insert = $this->roles->insert(['role' => $this->request->getVar('role'), 'admin_id' => htmlentities($id)]);
                if ($insert) {
                    alert('Success add role', 'success');
                    return redirect()->back();
                }
            } else {
                alert('Role already added', 'error');
                return redirect()->back();
            }
        } else {
            alert('Please Select Role to Set new Role', 'error');
            return redirect()->back();
        }
    }
    public function remove_roles($id)
    {
        try {
            $id = htmlentities($id);
            $this->roles->delete($id);
            alert("Delete Admin Roles SuccessFully :)", 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            alert("Delete Admin Roles Failed :(", 'error');
            return redirect()->back();
        }
    }
}
