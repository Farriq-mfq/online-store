<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductTags as ModelsProductTags;
use App\Models\Tags;

class ProductTags extends BaseController
{
    private Product $product;
    private Tags $tags;
    private ModelsProductTags $prdTags;
    public function __construct()
    {
        $this->product = new Product();
        $this->tags = new Tags();
        $this->prdTags = new ModelsProductTags();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_tags")->find();
        $data['tags'] = $this->tags->findAll();
        return view("admin/product/tags/index", add_data("Tags Product", "product/tags", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $tags = $this->prdTags->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($tags);
        }
    }
    public function store($productID)
    {
        $validate = $this->validate([
            "tag" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_TAGS", admin_url("/product/tags/" . $productID));
            return redirect()->back()->withInput();
        }
        $data = [
            "tag_id" => $this->request->getVar('tag'),
            "product_id" => $productID
        ];
        if ($this->prdTags->insert($data)) {
            alert("Success Add Tag", "success");
        }
        return redirect()->back();
    }
    public function update($id)
    {
        $validate = $this->validate([
            "tag" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_TAGS", admin_url("/product/tags/" . $id));
            return redirect()->back()->withInput();
        }
        $data = [
            "tag_id" => $this->request->getVar('tag'),
        ];
        if ($this->prdTags->update($id, $data)) {
            alert("Success Update Tags", "success");
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $delete = $this->prdTags->delete($id);
            if ($delete) {
                alert("Success delete Tag", "success");
                return redirect()->back();
            }
        } catch (\Exception $e) {
            alert("Internal Server error", "error");
        }
    }
}
