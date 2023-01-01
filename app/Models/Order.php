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
        $detail_by_month_this_year = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 1 YEAR) AND CURRENT_DATE")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        $detail_by_month_last_year = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 2 YEAR) AND date_sub(CURRENT_DATE,INTERVAL 1 YEAR)")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        $total_this_year = 0;
        foreach ($detail_by_month_this_year as $v) {
            $total_this_year += $v->total_permonth;
        }
        $total_last_year = 0;
        foreach ($detail_by_month_last_year as $v) {
            $total_last_year += $v->total_permonth;
        }
        $total_sales = $total_this_year + $total_last_year;
        $total_this_permonth = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where("month(created_at)=month(CURRENT_DATE)")->where('YEAR(CURRENT_DATE) = YEAR(created_at)')->first();
        $total_last_permonth = $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where("month(created_at)=month(date_sub(CURRENT_DATE,INTERVAL 1 MONTH))")->where('YEAR(CURRENT_DATE) = YEAR(created_at)')->first();
        $percentage_this_year =  $total_sales ?  floor($total_this_year / $total_sales * 100) : 0;
        $percentage_last_year =  $total_sales ?  floor($total_last_year / $total_sales * 100) : 0;
        // increst
        $increase_permonth =   $total_last_permonth->total_permonth > 0 && $total_this_permonth->total_permonth > 0 ? floor(($total_this_permonth->total_permonth - $total_last_permonth->total_permonth) / $total_last_permonth->total_permonth * 100) : 0;
        $decrease_permonth =   $total_last_permonth->total_permonth > 0 && $total_this_permonth->total_permonth > 0 ? floor(($total_last_permonth->total_permonth - $total_this_permonth->total_permonth) / $total_last_permonth->total_permonth * 100) : 0;

        return [
            'total_sales' => $total_sales,
            'total_this_year' => $total_this_year,
            'total_last_year' => $total_last_year,
            'detail_by_month_this_year' => $detail_by_month_this_year,
            'detail_by_month_last_year' => $detail_by_month_last_year,
            'percentage_this_year' => $percentage_this_year,
            'percentage_last_year' => $percentage_last_year,
            'total_this_permonth' => $total_this_permonth,
            'total_last_permonth' => $total_last_permonth,
            'increase_permonth' => $increase_permonth,
            'decrease_permonth' => $decrease_permonth
        ];
    }

    public function getFilterYear()
    {
        return $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("YEAR(created_at) as 'year'")->groupBy('year')->findAll();
    }

    public function getReportByYear($year = null)
    {
        if ($year == null) {
            return $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where("YEAR(CURRENT_DATE)=YEAR(created_at)")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        } else {
            return $this->without('order_items')->where('status!=', "WAITING")->where('status!=', "REJECT")->select("MONTHNAME(created_at) as 'month',sum(subtotal) as 'total_permonth',year(created_at) as 'year'")->where(" " . $year . "=YEAR(created_at)")->groupBy('MONTHNAME(created_at)')->orderBy('month', "ASC")->findAll();
        }
    }

    public function productSales($month = null, $year = null)
    {
        if ($month == null && $year == null) {
            $this_month = $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('order_items.total,order_items.product_id,orders.created_at,products.title,products.price,orders.token,order_items.order_items_id,order_items.quantity,sum(order_items.quantity) as "total_sales",monthname(orders.created_at) as "month",YEAR(orders.created_at) as "year"')->where('month(orders.created_at)=month(CURRENT_DATE)')->where('year(orders.created_at)=year(CURRENT_DATE)')->groupBy('products.product_id')->join('products', 'products.product_id=order_items.product_id')->findAll();
            $last_month = $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('order_items.total,order_items.product_id,orders.created_at,products.title,products.price,orders.token,order_items.order_items_id,order_items.quantity,sum(order_items.quantity) as "total_sales",monthname(orders.created_at) as "month"')->where('month(orders.created_at)=month(date_sub(CURRENT_DATE,INTERVAL 1 MONTH))')->where('year(orders.created_at)=year(CURRENT_DATE)')->groupBy('products.product_id')->join('products', 'products.product_id=order_items.product_id')->findAll();
        } else {
            $this_month = $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('order_items.total,order_items.product_id,orders.created_at,products.title,products.price,orders.token,order_items.order_items_id,order_items.quantity,sum(order_items.quantity) as "total_sales",monthname(orders.created_at) as "month",YEAR(orders.created_at) as "year"')->where('monthname(orders.created_at)="' . $month . '"')->where('year(orders.created_at)="' . $year . '"')->groupBy('products.product_id')->join('products', 'products.product_id=order_items.product_id')->findAll();
            // dd($this->db->showLastQuery());
            $last_month = $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('order_items.total,order_items.product_id,orders.created_at,products.title,products.price,orders.token,order_items.order_items_id,order_items.quantity,sum(order_items.quantity) as "total_sales",monthname(orders.created_at) as "month"')->where('month(orders.created_at)="' . date("m", strtotime($month)) - 1 . '"')->where('year(orders.created_at)="' . $year . '"')->groupBy('products.product_id')->join('products', 'products.product_id=order_items.product_id')->findAll();
        }
        $data = [];
        foreach ($this_month as $key => $dt) {
            $ls =  isset($last_month[$key]) ? $last_month[$key] : null;
            $last_sl = isset($ls->total_sales) ? $ls->total_sales : 0;
            $data[] = [
                'product_title' => $dt->title,
                'month' => $dt->month,
                'sold_this' => $dt->total_sales,
                'price' => $dt->price,
                'created_at' => $dt->created_at,
                'sold_last' => $last_sl,
                'increst' => $last_sl != null && $dt->total_sales != 0 ? floor(($dt->total_sales - $last_sl) / $last_sl * 100) : 0,
                'decrest' => $last_sl != null && $dt->total_sales != 0 ? floor(($last_sl - $dt->total_sales) / $last_sl * 100) : 0,
                'year' => $dt->year
            ];
        }
        return $data;
    }

    public function month_filter_product_sales()
    {
        return $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('monthname(orders.created_at) as "month"')->groupBy('month')->findAll();
    }
    public function year_filter_product_sales()
    {
        return $this->without('order_items')->where('orders.status!=', "WAITING")->where('orders.status!=', "REJECT")->join("order_items", 'order_items.order_id=orders.order_id', "RIGHT")->select('YEAR(orders.created_at) as "year"')->groupBy('year')->findAll();
    }
}
