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
        $data['detail_visitor'] = $this->visitor->getdetailvisitorcount();
        $data['report_sales'] = $this->order->report();
        return view('admin/home_view', add_data("Home", "/index", $data));
    }

    public function apiGetVisitorToday()
    {
        if ($this->request->isAJAX()) {
            $thisweek = [];
            $last_week = [];
            $data_last_week = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 14 DAY) AND date_sub(CURRENT_DATE,INTERVAL 7 DAY)")->orderBy("DAYOFWEEK(created_at)")->findAll();
            $visitors = $this->visitor->select("DAYNAME(created_at) as 'day',COUNT(*) as 'total'")->groupBy("day")->where('date_format(created_at,"%Y-%m")', date("Y-m"))->where("date_format(created_at,'%Y-%m-%d') BETWEEN date_sub(CURRENT_DATE,INTERVAL 7 DAY) AND CURRENT_DATE")->orderBy("DAYOFWEEK(created_at)")->findAll();
            for ($i = 0; $i < 7; $i++) {
                $thisweek[] = isset($visitors[$i]) ? $visitors[$i]->total : '0';
                $last_week[] = isset($data_last_week[$i]) ? $data_last_week[$i]->total : '0';
            }
            return $this->response->setJSON(['this_week' => $thisweek, 'last_week' => $last_week]);
        }
    }
    public function apiGetSalesToday()
    {
        if ($this->request->isAJAX()) {
            $month = [];
            $thisyear = [];
            $lastyear = [];
            $data_sales_this_year = $this->order->report()['detail_by_month_this_year'];
            $detail_by_month_last_year = $this->order->report()['detail_by_month_last_year'];
            foreach ($data_sales_this_year as $sales) {
                $month[] = $sales->month;
                $thisyear[] = $sales->total_permonth;
            }
            foreach ($detail_by_month_last_year as $sales) {
                $lastyear[] = $sales->total_permonth;
            }
            return $this->response->setJSON(['this_year' => $thisyear,'last_year'=>$lastyear, 'key' => $month]);
        }
    }
}
