<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Product;
use App\Models\ProductInventories;
class ProductInventoriesController extends BaseController
{
    private ProductInventories $productInventories;
    private Product $product;
    public function __construct()
    {
        $this->productInventories  = new ProductInventories();
        $this->product  = new Product();
    }
    public function index()
    {
        $data['products'] =$this->product->with("product_inventories")->find();
        return view("admin/product/inventories/index",add_data("Inventories Product","product/inventories",$data));
    }
    public function store($productID)
    {
        $validate = $this->validate([
            "size"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field size empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "color"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Field color empty"
                ]
            ],
            "stock"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field stock empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "sku"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field sku empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "price"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field price empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
        ]);

        if(!$validate){
            session()->setFlashdata("validation",$this->validator->getErrors());
            session()->setFlashdata("action_session_inventories",admin_url("/product/inventories/".$productID));
            return redirect()->back()->withInput();
        }

        $data = [
            'size'=>$this->request->getVar("size"),
            'color'=>$this->request->getVar("color"),
            'price'=>$this->request->getVar("price"),
            'stock'=>$this->request->getVar("stock"),
            'sku'=>$this->request->getVar("sku"),
            "product_id"=>$productID
        ];

        $this->productInventories->insert($data);
        alert("Success Add Inventories","success"); 
        return redirect()->back();
        
    }
    public function remove($id)
    {
        try{
            $this->productInventories->delete($id);
            alert("Success delete Inventories","success"); 
            return redirect()->back();
        }catch(\Exception $e){
            alert("Internal Server error","error"); 
        }
    }
    public function edit()
    {
        if($this->request->isAjax()){
            header('Content-Type: application/json');
            $inventory = $this->productInventories->find((int)esc($this->request->getVar("id")));
            return json_encode($inventory);
        }
    }
    public function update($id)
    {
        $validate = $this->validate([
            "size"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field size empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "color"=>[
                "rules"=>"required",
                "errors"=>[
                    "required"=>"Field color empty"
                ]
            ],
            "stock"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field stock empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "sku"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field sku empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
            "price"=>[
                "rules"=>"required|numeric",
                "errors"=>[
                    "required"=>"Field price empty",
                    "numeric"=>"Field only numeric"
                ]
            ],
        ]);

        if(!$validate){
            session()->setFlashdata("validation",$this->validator->getErrors());
            session()->setFlashdata("action_session_inventories",admin_url("/product/inventories/".$id));
            session()->setFlashdata("METHOD_UPDATE_SESSION",true);
            return redirect()->back()->withInput();
        }

        $data = [
            'size'=>$this->request->getVar("size"),
            'color'=>$this->request->getVar("color"),
            'price'=>$this->request->getVar("price"),
            'stock'=>$this->request->getVar("stock"),
            'sku'=>$this->request->getVar("sku"),
        ];

        $this->productInventories->update($id,$data);
        alert("Success Update Inventories","success"); 
        return redirect()->back();
    }
}
