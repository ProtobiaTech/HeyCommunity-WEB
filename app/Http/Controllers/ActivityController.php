<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    /**
     * Activity List Page
     */
    public function index()
    {
        $exhibits = Activity::inRandomOrder()->limit(3)->get();
        $activities = Activity::paginate();

        return view('activity.index', compact('activities', 'exhibits'));
    }

    /**
     *
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activity.show', compact('activity'));
    }
}
