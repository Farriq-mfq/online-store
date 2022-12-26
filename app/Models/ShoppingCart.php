<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class ShoppingCart extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'session_cart';
    protected $primaryKey       = 'session_cart_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["user_id", "product_id", "content", "product_img", "quantity", "price", "total"];
    protected $with = ["products"];

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

    public function getTotalCart()
    {
        return $this->where("user_id", auth_user_id())->without("products")->select("sum(total) as 'total_cart'")->groupBy("user_id")->first();
    }
    public function getGrandTotal($shipping)
    {
        return $this->getTotalCart()->total_cart + (int) $shipping;
    }

    public function getWeightProduct()
    {
        return $this->where("user_id", auth_user_id())->without("products")->join("products", "session_cart.product_id=products.product_id")->select("SUM(quantity * weight) as 'total_weight'")->first();
    }
}
