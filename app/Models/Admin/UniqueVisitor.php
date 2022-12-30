<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UniqueVisitor extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'unique_visitor';
    protected $primaryKey       = 'visit_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["ip", 'created_at'];

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
    public function getdetailvisitorcount()
    {
        $data_last_week = $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 13 DAY) AND date_sub(CURRENT_DATE,INTERVAL 7 DAY)")->orderBy("DAYOFWEEK(created_at)")->findAll();
        $data_this_week = $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 6 DAY) AND CURRENT_DATE")->orderBy("DAYOFWEEK(created_at)")->findAll();
        $total_lastweek = 0;
        foreach ($data_last_week as $last_week) {
            $total_lastweek += $last_week->total;
        }
        $total_thisweek = 0;
        foreach ($data_this_week as $this_week) {
            $total_thisweek += $this_week->total;
        }

        $total_all_visitor = $total_lastweek + $total_thisweek;
        $percentage_last_week = $total_all_visitor ? floor($total_lastweek / $total_all_visitor * 100) : 0;
        $percentage_this_week =  $total_all_visitor ? floor($total_thisweek / $total_all_visitor * 100) : 0;
        $increase_perweek =   floor(($total_thisweek - $total_lastweek) / $total_lastweek * 100);
        $decrease_perweek =   floor(($total_lastweek - $total_thisweek) / $total_lastweek * 100);
        return [
            'percentage_thisweek' => $percentage_this_week,
            'percentage_lastweek' => $percentage_last_week,
            'total_thisweek' => $total_thisweek,
            'total_lastweek' => $total_lastweek,
            'increase_perweek' => $increase_perweek,
            'decrease_perweek' => $decrease_perweek,
        ];
    }
    public function getVisitorByMonth($year = null, $month = null)
    {
        if ($month == null && $year == null) {
            return $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total',MONTHNAME(created_at) as 'month',YEAR(created_at) as 'year'")->groupBy("day")->where("MONTH(created_at)=MONTH(CURRENT_DATE)")->orderBy("DAYOFWEEK(created_at)")->findAll();
        } else {
            return $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total',MONTHNAME(created_at) as 'month',YEAR(created_at) as 'year'")->groupBy("day")->where("MONTHNAME(created_at)='".$month."'")->where("YEAR(created_at)= '".$year."'")->orderBy("DAYOFWEEK(created_at)")->findAll();
        }
    }
    public function gerYearFilter()
    {
        return $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total',MONTHNAME(created_at) as 'month',YEAR(created_at) as 'year'")->groupBy("year")->orderBy("DAYOFWEEK(created_at)")->findAll();
    }
    public function gerMonthFilter()
    {
        return $this->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total',MONTHNAME(created_at) as 'month',YEAR(created_at) as 'year'")->groupBy("month")->orderBy("DAYOFWEEK(created_at)")->findAll();
    }
}
