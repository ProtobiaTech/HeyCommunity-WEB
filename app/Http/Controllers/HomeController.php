<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Home Page
     */
    public function index()
    {
        return view('home.index');
    }
}
