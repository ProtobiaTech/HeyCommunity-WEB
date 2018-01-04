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
        $activities = Activity::latest()->paginate(12);

        return view('activity.index', compact('activities', 'exhibits'));
    }

    /**
     * Show A Activity
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activity.show', compact('activity'));
    }

    /**
     * Create Activity Page
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Store Activity
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'intro'         =>  'required|string',
            'content'       =>  'required|string',
            'avatar'        =>  'required|image',
        ]);

        $avatarUrl  = $request->file('avatar')->store('uploads/activity/avatar');

        if ($avatarUrl) {
            $activity = new Activity();
            $activity->title = $request->title;
            $activity->intro = $request->intro;
            $activity->content = $request->content;
            $activity->avatar = $avatarUrl;

            if ($activity->save()) {
                return redirect()->route('activity.show', $activity->id);
            }
        }

        flash('发布活动失败')->error();
        return back()->withInput();
    }
}
