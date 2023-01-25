<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductMeta as ModelsProductMeta;
use App\Models\Tags;

class ProductMeta extends BaseController
{
    private Product $product;
    private Tags $tags;
    private ModelsProductMeta $productmeta;
    public function __construct()
    {
        $this->product = new Product();
        $this->tags = new Tags();
        $this->productmeta = new ModelsProductMeta();
    }
    public function index()
    {
        $data['products'] = $this->product->with("product_meta")->find();
        // $data['tags'] = $this->tags->findAll();
        return view("admin/product/meta/index", add_data("Meta & SEO Product", "product/meta", $data));
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $meta = $this->productmeta->find((int)esc($this->request->getVar("id")));
            return $this->response->setJSON($meta);
        }
    }
    public function store($productID)
    {
        $validate = $this->validate([
            "key" => [
                'rules' => 'required|is_unique[product_meta.key]',
            ],
            "content" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_META", admin_url("/product/meta/" . $productID));
            return redirect()->back()->withInput();
        }
        $data = [
            "key" => $this->request->getVar('key'),
            "content" => htmlentities($this->request->getVar('content')),
            "product_id" => $productID
        ];
        if ($this->productmeta->insert($data)) {
            alert("Success Add Meta", "success");
        }
        return redirect()->back();
    }
    public function update($id)
    {
        $original = $this->productmeta->select("key")->find($id);
        if ($this->request->getVar('key') == $original->key) {
            $unique = "";
        } else {
            $unique = "|is_unique[product_meta.key]";
        }
        $validate = $this->validate([
            "key" => [
                'rules' => 'required' . $unique,
            ],
            "content" => [
                'rules' => 'required',
            ],
        ]);

        if (!$validate) {
            session()->setFlashdata("validation", $this->validator->getErrors());
            session()->setFlashdata("action_session_META", admin_url("/product/meta/" . $id));
            return redirect()->back()->withInput();
        }
        $data = [
            "key" => $this->request->getVar('key'),
            "content" => htmlentities($this->request->getVar('content')),
        ];
        if ($this->productmeta->update($id, $data)) {
            alert("Success Update Meta", "success");
        }
        return redirect()->back();
    }
    public function remove($id)
    {
        try {
            $delete = $this->productmeta->delete($id);
            if ($delete) {
                alert("Success delete Tag", "success");
                return redirect()->back();
            }
        } catch (\Exception $e) {
            alert("Internal Server error", "error");
        }
    }
}
