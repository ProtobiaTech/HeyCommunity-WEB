<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * About page
     */
    public function about()
    {
        return view('site.about');
    }

    /**
     * Help page
     */
    public function help()
    {
        return view('site.help');
    }

    /**
     * Terms page
     */
    public function terms()
    {
        return view('site.terms');
    }

    /**
     * Privacy page
     */
    public function privacy()
    {
        return view('site.privacy');
    }
}
