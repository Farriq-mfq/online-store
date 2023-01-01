<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmailTemplate;

class EmailTempalteController extends BaseController
{
    private EmailTemplate $template;
    public function __construct()
    {
        $this->template = new EmailTemplate();
    }
    public function index()
    {
        $data['templates'] = $this->template->findAll();
        return view('admin/mail/template', add_data("Email Template", 'mail/template', $data));
    }
    public function remove($id)
    {
        try {
            $this->template->delete($id);
            alert("Success delete template", "success");
        } catch (\Exception $e) {
            alert("Failed delete template", "error");
        }
        return redirect()->back();
    }

    public function get_update_template()
    {
        if ($this->request->isAJAX()) {
            $template = $this->template->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($template);
        }
    }
    public function store()
    {
        $validate = $this->validate(
            [
                "from_name" => 'required',
                'from_email' => 'required|valid_email',
                'content' => 'required',
                'type' => "required|is_unique[email_template.type]"
            ]
        );
        if ($validate) {
            $data = [
                'from_name' => $this->request->getVar("from_name"),
                'from_email' => $this->request->getVar("from_email"),
                'recipients' => $this->request->getVar("recipients"),
                'content' => htmlentities($this->request->getVar("content")),
                'type' => $this->request->getVar("type"),
            ];

            $this->template->insert($data);
            alert("Success add template", "success");
        } else {
            session()->setFlashdata("validation", $this->validator->getErrors());
        }
        return redirect()->back();
    }
    public function update()
    {
        $id = (int)esc($this->request->getVar("template_id"));
        $original = $this->template->select("type")->find($id);
        if ($this->request->getVar('type') == $original->type) {
            $unique = "";
        } else {
            $unique = "|is_unique[email_template.type]";
        }
        $validate = $this->validate(
            [
                "from_name" => 'required',
                'from_email' => 'required|valid_email',
                'content' => 'required',
                'type' => "required" . $unique
            ]
        );
        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("template_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
        } else {
            try {
                $data = [
                    'from_name' => $this->request->getVar("from_name"),
                    'from_email' => $this->request->getVar("from_email"),
                    'recipients' => $this->request->getVar("recipients"),
                    'content' => htmlentities($this->request->getVar("content")),
                    'type' => $this->request->getVar("type"),
                ];

                alert("Success update template", "success");
                $this->template->update($id, $data);
            } catch (\Exception $e) {
                alert("Internal Server error", "error");
            }
        }
        return redirect()->back();
    }
}
