<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;

class ConfirmationController extends Controller
{
    public function index()
    {
        if(!session()->has('success_message')){
            return  redirect('/');
        }

        return view('frontend.the_project.shop.pages.thankyou.index');
    }
}
