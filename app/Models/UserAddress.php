<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class UserAddress extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'user_address';
    protected $primaryKey       = 'user_address_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["firstname", "lastname", "phone", "address1", "address2", "province", "city", "postcode_zip", "address_notes", "primary", "user_id"];

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

    public function updatePrimary($id)
    {
        try {
            $builder = $this->db->table($this->table);
            $builder->where('user_id',auth_user_id());
            $builder->where("user_address_id!=", $id);
            $builder->update(["primary" => false]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
