<?php

if (!function_exists("printMenu")) {
    function printMenu(array $a)
    {
        $html = "";

        $html .= '<ul class="main-categories">';

        foreach ($a as $v) {
            if ($v['parent_category']) {
                $html .= '<ul class="tree" id="CATEGORY_' . $v['parent_category'] . '">
                            <li class="main-nav-list child"><a href="category nya sini">' . $v["category"] . '</a></li>
                         </ul>';
            } else {
                $html .= '<li class="main-nav-list"><a href="category nya sini">' . $v['category'] . '</a></li>';
            }

            if (isset($v['child'])) {
                $html .= printMenu($v['child']);
            }
        }

        $html .= "</ul>";
        return $html;
    }
}
