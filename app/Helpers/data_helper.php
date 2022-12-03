<?php 
    function add_data(string $title,string $active_page, array $array=[]):array{
        $data["title"] = $title;
        $data["active_page"] = $active_page;
        $data["breadcrumbs"] = explode("/",$active_page);
        return array_merge($data,$array);
    }