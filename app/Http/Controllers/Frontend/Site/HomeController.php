<?php

namespace App\Http\Controllers\Frontend\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::with('details')->public()->orderBy('price', 'ASC')->get();

        return view('frontend.the_project.site.pages.home.index', compact('plans'));
    }

    public function plan($url)
    {
        if (!$plan = Plan::where('url', $url)->first()) {
            return redirect()->back()->with('info', 'Nenhum plano encontrado');
        }

        session()->put('plan', $plan);

        if (auth()->check() && !auth()->user()->subscribed('default')) {
            return redirect()->route('subscriptions.checkout');
        }

        return redirect()->route('register');
    }
}
