<?php

use Config\Services;

if (!function_exists('findPayment')) {
    function findPayment($id)
    {
        return Services::paymentservice()->get_status($id);
    }
}
