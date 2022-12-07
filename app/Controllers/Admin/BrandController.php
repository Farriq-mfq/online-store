<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Brands;

class BrandController extends BaseController
{
    private Brands $brands;
    public function __construct()
    {
        $this->brands = new Brands();
    }
    public function index()
    {
        $data['brands'] = $this->brands->find();
        return view('admin/brands/index',add_data("All Brands","brands/index",$data));
    }
    public function store()
    {
        $validate =$this->validate(
            [
                "brand"=>'required'
            ]
        );
        if($validate){
            $data = [
                'brand'=>$this->request->getVar("brand"),
            ];
            $this->brands->insert($data);
            alert("Success add Brands","success");
        }else{
            session()->setFlashdata("validation",$this->validator->getErrors());
        }
        return redirect()->back();
    }
    public function update()
    {
        return "ok";
    }
    public function remove($id)
    {
        try {
            $this->brands->delete($id);
            alert("Success delete Brands","success");
        } catch (\Exception $e) {
            alert("Failed delete Brands","error");
        }
        return redirect()->back();
    }
}
