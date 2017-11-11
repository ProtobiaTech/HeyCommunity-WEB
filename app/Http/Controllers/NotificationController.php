<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Notification Index Page
     */
    public function index()
    {
        return view('notification.index');
    }
}
