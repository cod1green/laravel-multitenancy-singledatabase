<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function pdv()
    {
        return view('admin.pages.sales.pdv');
    }
}
