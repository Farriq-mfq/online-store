<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SMTP;

class MailController extends BaseController
{
    private SMTP $smtp;
    public function __construct()
    {
        $this->smtp = new SMTP();
    }
    public function index()
    {
        $data['mail'] = $this->smtp->first();
        return view('admin/mail/index', add_data("Setting Smtp", "mail/index", $data));
    }

    public function promo()
    {
        return 'send';
    }
    public function add()
    {
        $validate = [
            'protocol' => "required",
            'host' => 'required',
            'user' => 'required|valid_email',
            'password' => 'required',
            'port' => 'required|numeric',
            'crypto' => 'required',
            'type' => 'required',
        ];

        if ($this->validate($validate)) {
            $data = [
                'protocol' => $this->request->getVar('protocol'),
                'host' => $this->request->getVar('host'),
                'user' => $this->request->getVar('user'),
                'password' => $this->request->getVar('password'),
                'port' => (int) $this->request->getVar('port'),
                'crypto' => $this->request->getVar('crypto'),
                'type' => $this->request->getVar('type'),
                'useragent'=>$this->request->getVar('useragent')
            ];
            if ($this->smtp->find() != null) {
                $this->smtp->update(null, $data);
                alert("Success Update new Smtp", 'success');
                return redirect()->back();
            } else {
                $this->smtp->insert($data);
                alert("Success Add new Smtp", 'success');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
    }
    public function testing()
    {
        return view('admin/mail/testing', add_data("Testing mail", "mail/testing"));
    }
    public function run_test()
    {
        if ($this->request->isAJAX()) {
            if ($this->validate(['email' => 'required|valid_email'])) {
                if($this->mail->sendTesting($this->request->getVar('email'))){
                    return $this->response->setJSON(['success' => true]);
                }else{
                    return $this->response->setJSON(['success' => false]);
                }
            } else {
                return $this->response->setStatusCode(400)->setJSON(['validation' => $this->validator->getErrors()]);
            }
        }
    }
}
