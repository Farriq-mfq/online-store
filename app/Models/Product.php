<?php

namespace App\Models;

use CodeIgniter\Model;
class Product extends Model
{
    use \Tatter\Relations\Traits\ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["title","slug","short_description","description","category_id","content","price","weight","featured","new_label","status","brand_id","stock","sku"];
    protected $with = ["brands","categories","product_images","product_discount"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function addNew(array $data)
    {   
        try{
            $productData = pick($data,["title","slug","short_description","description","category_id","content","price","weight","featured","new_label","status","brand_id","stock","sku"]);
            $insert = $this->insert($productData);
            $productTags = batch_convert(pick($data,['tag_id']),["product_id"=>$insert]);
            $productTagsBuilder = $this->db->table("product_tags");
            $productTagsBuilder->insertBatch($productTags);
            $productImagesBuilder = $this->db->table("product_images");
            $productImage = array_merge(pick($data,["product_image"])["product_image"],["product_id"=>$insert]);
            $productImagesBuilder->insert($productImage);
            return true;
        }catch(\Exception $e){
            dd($e);
            return false;
        }
    }
    public function update_product(int $id,array $data)
    {
        try{    
            $productBuilder = $this->db->table($this->table);   
            $productData = pick($data,["title","slug","short_description","description","category_id","content","price","weight","featured","new_label","status","brand_id"]);
            $productBuilder->where("product_id",$id);
            $productBuilder->update($productData);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    public function active_inactive($id):bool
    {   
        try{
            if($this->find($id)->status){
                $this->update($id,['status'=>false]);
            }else{
                $this->update($id,['status'=>true]);
            }
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    public function featured_unfeatured($id):bool
    {
        try{
            if($this->find($id)->featured){
                $this->update($id,['featured'=>false]);
            }else{
                $this->update($id,['featured'=>true]);
            }
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    public function new_label_remove_label($id):bool
    {
        try{
            if($this->find($id)->new_label){
                $this->update($id,['new_label'=>false]);
            }else{
                $this->update($id,['new_label'=>true]);
            }
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
