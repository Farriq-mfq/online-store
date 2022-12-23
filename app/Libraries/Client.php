<?php 

namespace App\Libraries;

use App\Models\Categories;

class Client {
    private Categories $categories;
    public function __construct()
    {
        $this->categories = new Categories();
    }
    public function renderHeader()
    {
        $data['categories'] = $this->categories->getCategoriesByParentId();
        return view("Layouts/client/client_header",$data);
    }
}