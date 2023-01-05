<?php

if (!function_exists("printcategories")) {
    function printcategories(array $a)
    {
        $html = "";
        if (!is_array($a)) {
            return;
        }

        foreach ($a as $v) {
            if ($v['parent_category']) {
                $html .= '<li><a href="' . base_url('/shop?category_id=' . $v['category_id']) . '">' . $v['category'] . '</a></li>';
            }

            if (isset($v['child'])) {
                $html .= '<li class="cat-item has-children">
                <a href="' . base_url('/shop?category_id=' . $v['category_id']) . '">' . $v['category'] . '</a>
                     <ul class="sub-menu">' . printcategories($v['child']) . '</ul>
                </li>';
            }
        }

        return $html;
    }
}


if (!function_exists("printMenu")) {
    function printMenu($pages = null)
    {
        $html = "";


        $menus = [
            [
                "title" => "Home",
                "link" => base_url("/")
            ],
            [
                "title" => "Shop",
                "link" => base_url('/shop')
            ],
        ];

        foreach ($menus as $menu) {
            $html .= '<li class="menu-item">
                <a href="' . $menu['link'] . '">' . $menu['title'] . '</a>
            </li>';
        }
        if ($pages != null) {
            $html .= '<li class="menu-item has-children">
            <a href="#">Pages</a>
            <ul class="sub-menu">
                ' . print_pages($pages) . '
            </ul>
        </li>';
        }

        return $html;
    }
}


if (!function_exists("print_pages")) {
    function print_pages($pages = null)
    {
        $html = "";
        foreach ($pages as $page) {
            $html .= '<li class="menu-item">
            <a href="' . base_url($page->path) . '">' . $page->path . '</a>
        </li>';
        }
        return $html;
    }
}
