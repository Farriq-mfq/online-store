<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Page;

class PageController extends BaseController
{
    private Page $page;
    public function __construct()
    {
        $this->page = new Page();
    }
    public function index()
    {
        $data['pages'] = $this->page->findAll();
        return view("admin/page/index", add_data("Page Content Management", 'page/index',$data));
    }
}
