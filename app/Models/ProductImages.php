<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImages extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_images';
    protected $primaryKey       = 'image_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["image","name","mime","is_primary","product_id"];

    // Dates
    protected $useTimestamps = false;
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
    public function update_is_primary($p_id):bool
    {
        try{
            $builder = $this->db->table($this->table);
            $builder->where("product_id",$p_id);
            $builder->update(["is_primary"=>false]);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
