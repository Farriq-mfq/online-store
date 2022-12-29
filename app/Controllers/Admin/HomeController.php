<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UniqueVisitor;
use App\Models\Order;

class HomeController extends BaseController
{
    private Order $order;
    private UniqueVisitor $visitor;
    public function __construct()
    {
        $this->order = new Order();
        $this->visitor = new UniqueVisitor();
    }
    public function index()
    {
        $data['total_order'] = $this->order->countAllResults();
        $data['total_visitor'] = $this->visitor->countAllResults();
        $data['detail_visitor'] = $this->getdetailvisitorcount();
        return view('admin/home_view', add_data("Home", "/index", $data));
    }

    public function apiGetVisitorToday()
    {
        if ($this->request->isAJAX()) {
            $day = [];
            $thisweek = [];
            $last_week = [];
            $data_last_week = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 14 DAY) AND date_sub(CURRENT_DATE,INTERVAL 7 DAY)")->orderBy("DAYOFWEEK(created_at)")->findAll();
            $visitors = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 7 DAY) AND CURRENT_DATE")->orderBy("DAYOFWEEK(created_at)")->findAll();
            for ($i = 0; $i < 7; $i++) {
                $thisweek[] = isset($visitors[$i]) ? $visitors[$i]->total : '0';
                $last_week[] = isset($data_last_week[$i]) ? $data_last_week[$i]->total : '0';
            }
            return $this->response->setJSON(['key' => $day, 'this_week' => $thisweek, 'last_week' => $last_week]);
        }
    }
    protected function getdetailvisitorcount()
    {
        $data_last_week = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 14 DAY) AND date_sub(CURRENT_DATE,INTERVAL 7 DAY)")->orderBy("DAYOFWEEK(created_at)")->findAll();
        $data_this_week = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 7 DAY) AND CURRENT_DATE")->orderBy("DAYOFWEEK(created_at)")->findAll();
        $total_all_visitor = $this->visitor->countAllResults();
        $total_lastweek = 0;
        foreach ($data_last_week as $last_week) {
            $total_lastweek += $last_week->total;
        }
        $total_thisweek = 0;
        foreach ($data_this_week as $this_week) {
            $total_thisweek += $this_week->total;
        }

        $percentage_last_week = floor($total_lastweek / $total_all_visitor * 100);
        $percentage_this_week = floor($total_thisweek / $total_all_visitor * 100);
        return [
            'percentage_thisweek' => $percentage_this_week,
            'percentage_lastweek' => $percentage_last_week,
            'total_thisweek'=>$total_thisweek,
            'total_lastweek'=>$total_lastweek,
        ];
    }
}
