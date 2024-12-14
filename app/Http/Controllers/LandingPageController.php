<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('landing.index');
    }
    public function rooms()
    {
        return view('landing.rooms');
    }
    public function about()
    {
        return view('landing.about');
    }
    public function news()
    {
        return view('landing.news');
    }
    public function contact()
    {
        return view('landing.contact');
    }
}
