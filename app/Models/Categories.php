<?php

namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{
    use \Tatter\Relations\Traits\ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'category_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["parent_category","category"];

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

    public function getCategoriesByParentId(?int $parentId=null)
    {   
        $data =$this->db->table($this->table)->where("parent_category",$parentId)->get()->getResultArray();
        for($i=0;$i<count($data);$i++)
        {
            if($this->getCategoriesByParentId($data[$i]['category_id']))
            {
                $data[$i]['child']=$this->getCategoriesByParentId($data[$i]['category_id']);
            }
        }
       return $data;
    }
}
