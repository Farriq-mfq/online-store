<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UniqueVisitor;
use App\Models\Order;
use App\Models\User;

class ReportController extends BaseController
{
    private Order $order;
    private UniqueVisitor $visitor;
    private User $user;
    public function __construct()
    {
        $this->order = new Order();
        $this->visitor = new UniqueVisitor();
        $this->user = new User();
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
        return view('admin/report/index', add_data("Income Sales Report", "report/index", $data));
    }
    public function product_report()
    {
        $data['month_filter'] = $this->order->month_filter_product_sales();
        $data['year_filter'] = $this->order->year_filter_product_sales();
        $data['selected_month'] = $this->request->getVar('month') ?  htmlentities($this->request->getVar('month')) : "";
        $data['selected_year'] = $this->request->getVar('year') ? htmlentities($this->request->getVar('year')) : "";
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['product_sales_report'] = $this->order->productSales(htmlentities($this->request->getVar('month')), htmlentities($this->request->getVar('year')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['product_sales_report'] = $this->order->productSales();
            }
        } else {
            $data['product_sales_report'] = $this->order->productSales();
        }
        return view('admin/report/product', add_data("Product Sales Report", "report/product_sales", $data));
    }
    public function visitor_perweek()
    {
        $data['detail_visitor'] = $this->visitor->getdetailvisitorcount();
        $data['year_filter'] = $this->visitor->gerYearFilter();
        $data['month_filter'] = $this->visitor->gerMonthFilter();
        $data['selected_month'] = $this->request->getVar('month') ?  htmlentities($this->request->getVar('month')) : "";
        $data['selected_year'] = $this->request->getVar('year') ? htmlentities($this->request->getVar('year')) : "";
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth(htmlentities($this->request->getVar('year')), htmlentities($this->request->getVar('month')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth();
            }
        } else {
            $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth();
        }
        return view('admin/report/visitor', add_data("Visitor Report", "report/visitor", $data));
    }
    public function user_registration()
    {
        $data['detail_user_report'] = $this->user->report();
        $data['year_filter'] = $this->user->gerYearFilter();
        $data['month_filter'] = $this->user->gerMonthFilter();
        $data['selected_month'] = $this->request->getVar('month') ?  htmlentities($this->request->getVar('month')) : "";
        $data['selected_year'] = $this->request->getVar('year') ? htmlentities($this->request->getVar('year')) : "";
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['getUserbyMonth'] = $this->user->getReportBymonth(htmlentities($this->request->getVar('year')), htmlentities($this->request->getVar('month')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['getUserbyMonth'] = $this->user->getReportBymonth();
            }
        } else {
            $data['getUserbyMonth'] = $this->user->getReportBymonth();
        }
        return view('admin/report/user', add_data("User Registration Report", "report/user", $data));
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
        $mpdf->Output('sales-' . date("Y-m-d") . '.pdf', 'I');
    }
    public function generete_pdf_report_visitor()
    {
        $mpdf = new \Mpdf\Mpdf();
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth(htmlentities($this->request->getVar('year')), htmlentities($this->request->getVar('month')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth();
            }
        } else {
            $data['getVisitorByMonth'] = $this->visitor->getVisitorByMonth();
        }

        $html = view('pdf/visitor', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('visitor-' . date("Y-m-d") . '.pdf', 'I');
    }
    public function generete_pdf_report_user()
    {
        $mpdf = new \Mpdf\Mpdf();
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['getUserbyMonth'] = $this->user->getReportBymonth(htmlentities($this->request->getVar('year')), htmlentities($this->request->getVar('month')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['getUserbyMonth'] = $this->user->getReportBymonth();
            }
        } else {
            $data['getUserbyMonth'] = $this->user->getReportBymonth();
        }

        $html = view('pdf/user_report', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('user-report-' . date("Y-m-d") . '.pdf', 'I');
    }
    public function generete_pdf_report_product_sales()
    {
        $mpdf = new \Mpdf\Mpdf();

        $data['month_filter'] = $this->order->month_filter_product_sales();
        $data['year_filter'] = $this->order->year_filter_product_sales();
        $data['selected_month'] = $this->request->getVar('month') ?  htmlentities($this->request->getVar('month')) : "";
        $data['selected_year'] = $this->request->getVar('year') ? htmlentities($this->request->getVar('year')) : "";
        if (array_key_exists('month', $this->request->getVar()) && array_key_exists('year', $this->request->getVar())) {
            if ($this->validate(['month' => 'required', 'year' => 'required'])) {
                $data['product_sales_report'] = $this->order->productSales(htmlentities($this->request->getVar('month')), htmlentities($this->request->getVar('year')));
            } else {
                session()->setFlashdata('validation', $this->validator->getErrors());
                $data['product_sales_report'] = $this->order->productSales();
            }
        } else {
            $data['product_sales_report'] = $this->order->productSales();
        }
        $html = view('pdf/product_sales_report', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('product-sales-report-' . date("Y-m-d") . '.pdf', 'I');
    }
}
