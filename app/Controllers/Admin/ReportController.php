<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UniqueVisitor;
use App\Models\Order;

class ReportController extends BaseController
{
    private Order $order;
    private UniqueVisitor $visitor;
    public function __construct()
    {
        $this->order = new Order();
        $this->visitor = new UniqueVisitor();
    }
    public function product_sales_report()
    {
        $data['report_sales'] = $this->order->report();
        $data['filters'] = $this->order->getFilterYear();
        if ($this->request->getVar('year')) {
            $year = htmlentities($this->request->getVar('year'));
            $data['years'] = $this->order->getReportByYear($year);
        } else {
            $data['years'] = $this->order->getReportByYear();
        }

        $data['selected_year'] = $this->request->getVar('year') ? $this->request->getVar('year') : "";
        return view('admin/report/index', add_data("Product Sales Report", "report/index", $data));
    }
    public function product_report()
    {
    }
    public function visitor_perweek()
    {
        $data['detail_visitor'] = $this->visitor->getdetailvisitorcount();
        $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth();
        // dd($this->visitor->getVisitorByMonth());
        return view('admin/report/visitor', add_data("Visitor Report", "report/visitor", $data));
    }
    public function user_registration()
    {
    }

    public function generete_pdf_report_sales()
    {
        $mpdf = new \Mpdf\Mpdf();
        if ($this->request->getVar('year')) {
            $year = htmlentities($this->request->getVar('year'));
            $data['years'] = $this->order->getReportByYear($year);
        } else {
            $data['years'] = $this->order->getReportByYear();
        }

        $html = view('pdf/sales', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('sales.pdf', 'I');
    }
}
