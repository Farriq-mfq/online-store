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
    protected $allowedFields    = [];
    // protected $with = ['groups', 'permissions'];

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
            $productData = pick($data,["title","slug","short_description","description","product_category_id","content","price","weight","featured","new_label","status","product_brand_id"]);
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
}
