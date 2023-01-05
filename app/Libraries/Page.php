<?php

use CodeIgniter\Controller;
use Config\Services;

class Page
{
    private $routes;
    private $db;
    public function __construct($routes)
    {
        helper(["data", "url_helper", "menu_helper", "auth_helper"]);
        $this->db = db_connect();
        $this->routes = $routes;
    }

    public function renderPageDynamic()
    {
        $pages = $this->db->table('pages')->where('status',1)->get()->getResultObject();
        foreach ($pages as $page) {
            $this->routes->get($page->path, static function () use ($page) {
                $data['content'] = $page->content;
                return view("client/page/index", add_data($page->page_title, $page->path,$data));
            });
        }
    }
}
