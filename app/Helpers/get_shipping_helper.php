<?php

use App\Models\UserAddress;
use Config\Services;

function getCity($id)
{
    return Services::shippingservice()->get_city($id);    
}



function getProvince($id)
{
    return Services::shippingservice()->get_province($id);    
}
