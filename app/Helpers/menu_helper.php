<?php

if (!function_exists("printMenu")) {
    function printcategories(array $a)
    {
        $html = "";
        if (!is_array($a)) {
            return;
        }

        foreach ($a as $v) {
            if ($v['parent_category']) {
                $html .= '<li><a href="#">' . $v['category'] . '</a></li>';
            }

            if (isset($v['child'])) {
                $html .= '<li class="cat-item has-children"><a href="#">' . $v['category'] . '</a><ul class="sub-menu">' . printcategories($v['child']) . '</a></ul></li>';
            }
        }

        return $html;
    }
}


if (!function_exists("printMenu")) {
    function printMenu()
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
            [
                "title" => "Pages",
                "link" => "/",
                "child" => [
                    [
                        "title" => "About us",
                        "link" => "/",
                    ],
                    [
                        "title" => "Contact",
                        "link" => "/",
                    ],
                ],
            ],
        ];

        foreach ($menus as $menu) {
            if (isset($menu["child"])) {
                $child = "";
                foreach ($menu['child'] as $c) {
                    $child .= '<li> <a href="'.$c['link'].'">'.$c['title'].'</a></li>';
                }
                $html .= '<li class="menu-item has-children">
                            <a href="'.$menu['link'].'">' . $menu['title'] . '</a>
                            <ul class="sub-menu">
                                ' . $child . '
                            </ul>
                        </li>';
            } else {

                $html .= '<li class="menu-item">
                <a href="'.$menu['link'].'">' . $menu['title'] . '</a>
            </li>';
            }
        }

        return $html;
    }
}
