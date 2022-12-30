<?php

namespace App\Libraries;

use App\Models\Categories;
use App\Models\Website;

class Client
{
    private Categories $categories;
    private Website $website;
    public function __construct()
    {
        $this->categories = new Categories();
        $this->website = new Website();
    }
    public function renderHeader()
    {
        $data['categories'] = $this->categories->getCategoriesByParentId();
        $data['website'] = $this->website->first();
        return view("Layouts/client/client_header", $data);
    }
    public function renderFavicon()
    {
        $website = $this->website->first();
        $favicon = $website ? $website->favicon : "";
        return '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon . '" />';
    }
    public function renderTitle($title)
    {
        $website = $this->website->first();
        $title_separator = $website ? $website->title_separator : "";
        return '<title>' . $title_separator . ' - ' . $title . '</title>';
    }
    public function renderFooter()
    {
        $data['website'] = $this->website->first();
        return view("/Layouts/client/client_footer", $data);
    }
}
