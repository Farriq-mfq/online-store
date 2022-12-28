<?php 

namespace App\Libraries;

use App\Models\Order;

class Admin {
    private Order $order;
    public function __construct()
    {
        $this->order = new Order();
    }
    public function renderOrderMenu()
    {
        $data['all'] = $this->order->countAllResults();
        $data['waiting'] = $this->order->where('status',"WAITING")->countAllResults();
        $data['process'] = $this->order->where('status',"PROCESS")->countAllResults();
        $data['shipped'] = $this->order->where('status',"SHIPPED")->countAllResults();
        $data['done'] = $this->order->where('status',"DONE")->countAllResults();
        $data['rejected'] = $this->order->where('status',"REJECTED")->countAllResults();
        return view("widget/order_menu",$data);
    }
}