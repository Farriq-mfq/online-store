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
                'rules' => 'required|is_unique[product_tags.tag_id]',
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
        $original = $this->prdTags->select("tag_id")->find($id);
        if ($this->request->getVar('tag') == $original->tag_id) {
            $unique = "";
        } else {
            $unique = "|is_unique[product_tags.tag_id]";
        }
        $validate = $this->validate([
            "tag" => [
                'rules' => 'required'.$unique,
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
    public function is_primary($id)
    {
        try {
            $image = $this->productImages->find($id);
            if ($this->productImages->update_is_primary($image->product_id)) {
                $this->productImages->update($id, ["is_primary" => true]);
                alert("Success Update Primary Images", "success");
            } else {
                alert("Failed", "error");
            }
            return redirect()->back();
        } catch (\Exception $e) {
            alert("Internal Server error", "error");
        }
    }
}
