<?php
function add_data(string $title, string $active_page, array $array = []): array
{
    $data["title"] = $title;
    $data["active_page"] = $active_page;
    $data["breadcrumbs"] = explode("/", $active_page);
    return array_merge($data, $array);
}

// function getMinMax($primaryPrice,$inventories)
// {
//     $data =[];
//     foreach ($inventories as $v) {
//         $data[] = $v->price;
//     }
//     $arr_price = array_merge([$primaryPrice],$data);
//     return "Rp.".number_format(min($arr_price),0,",",".")." - ".number_format(max($arr_price),0,",",".");
// }


function get_avg(array $data, string $key)
{
    $total = 0;
    foreach ($data as $v) {
        $total += $v->$key;
    }

    return ceil($total / count($data));
}
