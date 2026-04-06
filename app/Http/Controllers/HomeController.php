<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home.index', compact('banners'));
    }
}
