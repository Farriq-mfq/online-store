<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Page;

class PageController extends BaseController
{
    private Page $page;
    public function __construct()
    {
        $this->page = new Page();
    }
    public function index()
    {
        $data['pages'] = $this->page->findAll();
        return view("admin/page/index", add_data("Page Content Management", 'page/index', $data));
    }
    public function store()
    {
        $validate = $this->validate(
            [
                "page_title" => 'required',
                'path' => "required|is_unique[pages.path]",
                'content' => 'required'
            ]
        );
        if ($validate) {
            $data = [
                'page_title' => $this->request->getVar("page_title"),
                'path' => $this->request->getVar("path"),
                'status' => $this->request->getVar("status") != null ? true : false,
                'content' => htmlentities($this->request->getVar('content')),
            ];

            $this->page->insert($data);
            alert("Success add page", "success");
        } else {
            session()->setFlashdata("validation", $this->validator->getErrors());
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $this->page->delete($id);
            alert("Success delete Page", "success");
        } catch (\Exception $e) {
            alert("Failed delete Page", "error");
        }
        return redirect()->back();
    }
    public function get_update_page()
    {
        if ($this->request->isAJAX()) {
            $tag = $this->page->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($tag);
        }
    }

    public function update()
    {
        $id = (int)esc($this->request->getVar("page_id"));
        $original = $this->page->select("path")->find($id);
        if ($this->request->getVar('path') == $original->path) {
            $unique = "";
        } else {
            $unique = "|is_unique[pages.path]";
        }
        $validate = $this->validate(
            [
                "page_title" => 'required',
                'content' => 'required',
                "path" => 'required' . $unique
            ]
        );
        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("page_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
        } else {
            try {
                alert("Success update Page", "success");
                $data = [
                    'page_title' => $this->request->getVar("page_title"),
                    'path' => $this->request->getVar("path"),
                    'status' => $this->request->getVar("status") != null ? true : false,
                    'content' => htmlentities($this->request->getVar('content')),
                ];
                $this->page->update($id, $data);
            } catch (\Exception $e) {
                alert("Internal Server error", "error");
            }
        }
        return redirect()->back();
    }
}
