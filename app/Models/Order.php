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
    protected $allowedFields    = ["midtrans_id", "token", "user_id", "courier", "shipping_tracking", "shipping_service", "origin", "destination_origin", "status", "discount", "is_cencel", "notes", "shipping_total", "subtotal", "payment_method", "user_address_id"];
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

    public function getSessionEmoneyByUser($token)
    {
        return $this->db->table("session_emoney")->where('user_id', auth_user_id())->where('order_id', $token)->get()->getFirstRow();
    }
    public function getSessionEmoney($token)
    {
        return $this->db->table("session_emoney")->where('order_id', $token)->get()->getFirstRow();
    }
    public function getPaymentStatus()
    {
        $orders = $this->where('user_id', auth_user_id())->findAll();
        $arr = [];
        foreach ($orders as $order) {
            $arr[] = findPayment($order->midtrans_id);
        }
        return $arr;
    }

    public function report()
    {
        $detail_by_month_this_year = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at)")->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 1 YEAR) AND CURRENT_DATE")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        $detail_by_month_last_year = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at)")->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 2 YEAR) AND date_sub(CURRENT_DATE,INTERVAL 1 YEAR)")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        $total_this_year = 0;
        foreach ($detail_by_month_this_year as $v) {
            $total_this_year += $v->total_permonth;
        }
        $total_last_year = 0;
        foreach ($detail_by_month_last_year as $v) {
            $total_last_year += $v->total_permonth;
        }
        $total_sales = $total_this_year + $total_last_year;
        $percentage_this_year =  $total_sales ?  floor($total_this_year / $total_sales * 100) : 0;
        $percentage_last_year =  $total_sales ?  floor($total_last_year / $total_sales * 100) : 0;
        $increase_permonth =   floor(($total_this_year - $total_last_year) / $total_last_year * 100);
        $decrease_permonth =   floor(($total_last_year - $total_this_year) / $total_last_year * 100);

        return [
            'total_sales' => $total_sales,
            'total_this_year' => $total_this_year,
            'total_last_year' => $total_last_year,
            'detail_by_month_this_year' => $detail_by_month_this_year,
            'detail_by_month_last_year' => $detail_by_month_last_year,
            'percentage_this_year' => $percentage_this_year,
            'percentage_last_year' => $percentage_last_year,
            'increase_permonth' => $increase_permonth,
            'decrease_permonth' => $decrease_permonth
        ];
    }
}
