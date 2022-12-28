<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class Order extends Model
{
    use ModelTrait;
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["midtrans_id", "token", "user_id", "courier", "shipping_tracking", "shipping_service", "origin", "destination_origin", "status", "discount", "is_cencel", "notes","shipping_total", "subtotal", "payment_method", "user_address_id"];
    protected $with = ['order_items'];

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

    public function getSessionEmoney($token)
    {
        return $this->db->table("session_emoney")->where('user_id',auth_user_id())->where('order_id',$token)->get()->getFirstRow();
    }
    public function getPaymentStatus()
    {
        $orders = $this->where('user_id',auth_user_id())->findAll();
        $arr=[];
        foreach ($orders as $order ) {
            $arr[] = findPayment($order->midtrans_id);
        }
        return $arr;
    }
}
