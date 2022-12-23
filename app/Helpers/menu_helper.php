<?php

if (!function_exists("printMenu")) {
    function printMenu(array $a)
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
                $html .= '<li class="cat-item has-children"><a href="#">' . $v['category'] . '</a><ul class="sub-menu">' . printMenu($v['child']) . '</a></ul></li>';
            }
        }

        return $html;
    }
}
