<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Categories;

class CategoryController extends BaseController
{
    private Categories $categories;
    public function __construct()
    {
        $this->categories = new Categories();
    }
    public function index()
    {
        $data['categories'] = $this->categories->with("categories")->find();
        $data['print_categories'] = $this->categories->getCategoriesByParentId();
        return view('admin/categories/index',add_data("All Categories","categories/index",$data));
    }
    public function remove($id)
    {
        try {
            $this->categories->delete($id);
            alert("Success delete Brands","success");
        } catch (\Exception $e) {
            alert("Failed delete Brands","error");
        }
        return redirect()->back();
    }
    public function get_update_category()
    {
        if($this->request->isAJAX()){
            header('Content-Type: application/json');
            $category = $this->categories->without("products")->find((int)esc($this->request->getVar("id")));
            return json_encode($category);
        }
    }
    public function store()
    {
        $validate =$this->validate(
            [
                "category"=>'required'
            ]
        );
        if($validate){
            $data = [
                'parent_category'=>empty($this->request->getVar("parent_category")) ?NULL:$this->request->getVar("parent_category"),
                'category'=>$this->request->getVar("category"),
            ];

            $this->categories->insert($data);
            alert("Success add Category","success");
        }else{
            session()->setFlashdata("validation",$this->validator->getErrors());
        }
        return redirect()->back();
    }
    public function update()
    {
        $validate =$this->validate(
            [
                "category"=>'required'
            ]
        );
        if(!$validate){
            session()->setFlashdata('update_id',(int)esc($this->request->getVar("category_id")));
            session()->setFlashdata("validation",$this->validator->getErrors());
        }else{
            try{
                $id = (int)esc($this->request->getVar("category_id"));
                $parent = empty($this->request->getVar("parent_category")) ?NULL:$this->request->getVar("parent_category");
                $datachildparent = [];
                if(!empty($this->request->getVar("parent_category"))){
                    $dataParent = $this->categories->with("categories")->find($id);
                    foreach($dataParent->categories as $child_parent){
                        $datachildparent[] = (int) $child_parent->category_id;
                    }
                }
                if(!in_array($parent,$datachildparent)){
                    if($this->categories->find($id)->category_id != $parent){
                        $this->categories->update($id,["category"=>$this->request->getVar("category"),'parent_category'=>$parent]);
                        alert("Success update category","success");
                    }else{
                        alert("cannot use own category","error");
                    }
                }else{
                    alert("ERROR","error");
                }
            }catch(\Exception $e){
                alert("Internal Server error","error");
            }
        }
        return redirect()->back();

    }
}
