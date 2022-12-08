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
    protected $allowedFields    = ["title","slug","short_description","description","category_id","content","price","weight","featured","new_label","status","brand_id"];
    protected $with = ["brands","categories","product_inventories","product_tags"];

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
            $productBuilder = $this->db->table($this->table);
            $productInventoriesBuilder = $this->db->table("product_inventories");
            $productImagesBuilder = $this->db->table("product_images");
            $productTagsBuilder = $this->db->table("product_tags");
            $productData = pick($data,["title","slug","short_description","description","category_id","content","price","weight","featured","new_label","status","brand_id"]);
            $productBuilder->insert($productData);
            $productInventories =batch_convert(pick($data,['inventories'])['inventories'],["product_id"=>$this->db->insertID()]);
            $productImage = array_merge(pick($data,["product_image"])["product_image"],["product_id"=>1]);
            $productTags = batch_convert(pick($data,['tags']),["product_id"=>$this->db->insertID()]);
            $productInventoriesBuilder->insertBatch($productInventories);
            $productImagesBuilder->insert($productImage);
            $productTagsBuilder->insertBatch($productTags);
            return true;
        }catch(\Exception $e){
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
