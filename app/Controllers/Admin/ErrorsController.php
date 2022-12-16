<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ErrorsController extends BaseController
{
    public function error_forbidden()
    {
        return view('/admin/errors/403',add_data("ERROR FORBIDDEN","error/forbidden"));
    }
}
