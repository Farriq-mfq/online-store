<?php

use SebastianBergmann\Timer\Duration;

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

function get_discount(int $oldprice, int $discount): int
{
    return $oldprice - ($oldprice * $discount / 100);
}
function get_less_price(int $oldprice, int $discount): int
{
    return $oldprice - $discount;
}

function format_rupiah($value)
{
    return "Rp." . number_format($value, 0, ",", ".");
}

function replace_date_to_slash($date)
{
    return str_replace("-", "/", $date);
}

function thousandsCurrencyFormat($num)
{

    if ($num > 1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

    return $num;
}


if (!function_exists('getCurrentNumber')) {
    function getCurrentNumber($currentPage, $perPage)
    {
        if (is_null($currentPage)) {
            $number = 1;
        } else {
            $number = 1 + ($perPage * ($currentPage - 1));
        }
        return $number;
    }
}
if (!function_exists('getEndPage')) {
    function getEndPage($currentPage, $total_items_perpage,$has_more,$total)
    {
        if($has_more){
            return $currentPage * $total_items_perpage;
        }else{
            return $total;
        }
    }
}
