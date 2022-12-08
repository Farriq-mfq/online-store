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
        $validate =$this->validate(
            [
                "brand"=>'required'
            ]
        );
        if(!$validate){
            session()->setFlashdata('update_id',(int)esc($this->request->getVar("brand_id")));
            session()->setFlashdata("validation",$this->validator->getErrors());
        }else{
            try{
                $this->brands->update((int)esc($this->request->getVar("brand_id")),["brand"=>$this->request->getVar("brand")]);
                alert("Success update brand","success");
            }catch(\Exception $e){
                alert("Internal Server error","error");
            }
        }
        return redirect()->back();

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
    public function get_update_brand()
    {
        if($this->request->isAJAX()){
            header('Content-Type: application/json');
            $brand = $this->brands->find((int)esc($this->request->getVar("id")));
            return json_encode($brand);
        }
    }
}
