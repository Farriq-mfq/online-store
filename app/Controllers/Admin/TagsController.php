<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Tags;

class TagsController extends BaseController
{
    private Tags $tags;
    public function __construct()
    {
        $this->tags = new Tags();
    }
    public function index()
    {
        $data['tags'] = $this->tags->find();
        return view('admin/tags/index', add_data("All tags", "tags/index", $data));
    }
    public function remove($id)
    {
        try {
            $this->tags->delete($id);
            alert("Success delete Tags", "success");
        } catch (\Exception $e) {
            alert("Failed delete Tags", "error");
        }
        return redirect()->back();
    }
    public function get_update_tags()
    {
        if ($this->request->isAJAX()) {
            $tag = $this->tags->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($tag);
        }
    }
    public function store()
    {
        $validate = $this->validate(
            [
                "tag" => 'required|is_unique[tags.tag]'
            ]
        );
        if ($validate) {
            $data = [
                'tag' => $this->request->getVar("tag"),
            ];

            $this->tags->insert($data);
            alert("Success add tag", "success");
        } else {
            session()->setFlashdata("validation", $this->validator->getErrors());
        }
        return redirect()->back();
    }
    public function update()
    {
        $id = (int)esc($this->request->getVar("tag_id"));
        $original = $this->tags->select("tag")->find($id);
        if ($this->request->getVar('tag') == $original->tag) {
            $unique = "";
        } else {
            $unique = "|is_unique[tags.tag]";
        }
        $validate = $this->validate(
            [
                "tag" => 'required' . $unique
            ]
        );
        if (!$validate) {
            session()->setFlashdata('update_id', (int)esc($this->request->getVar("tag_id")));
            session()->setFlashdata("validation", $this->validator->getErrors());
        } else {
            try {
                alert("Success update tag", "success");
                $this->tags->update($id, ["tag" => $this->request->getVar("tag")]);
            } catch (\Exception $e) {
                alert("Internal Server error", "error");
            }
        }
        return redirect()->back();
    }
}
