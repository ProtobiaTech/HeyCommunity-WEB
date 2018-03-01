<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Auth;

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
            'start_time'    =>  'required|string',
            'end_time'      =>  'required|string',
            'local'         =>  'required|string',
            'redirect_url'  =>  'required|string',
        ]);

        $avatarUrl  = $request->file('avatar')->store('uploads/activity/avatar');

        if ($avatarUrl) {
            $activity = new Activity();
            $activity->user_id = Auth::id();
            $activity->avatar = $avatarUrl;
            $activity->fill($request->only(['title', 'intro', 'content', 'start_time', 'end_time', 'local', 'redirect_url']));

            if ($activity->save()) {
                return redirect()->route('activity.show', $activity->id);
            }
        }

        flash('发布活动失败')->error();
        return back()->withInput();
    }

    /**
     * Edit Activity Page
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activity.edit', compact('activity'));
    }

    /**
     * Update Activity
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'intro'         =>  'required|string',
            'content'       =>  'required|string',
            'avatar'        =>  'image',
            'start_time'    =>  'required|string',
            'end_time'      =>  'required|string',
            'local'         =>  'required|string',
            'redirect_url'  =>  'required|string',
        ]);

        $activity = Activity::findOrFail($id);

        $activity->fill($request->only(['title', 'intro', 'content', 'start_time', 'end_time', 'local', 'redirect_url']));

        if ($request->avatar) {
            $avatarUrl  = $request->file('avatar')->store('uploads/activity/avatar');
            $activity->avatar = $avatarUrl;
        }

        if ($activity->save()) {
            return redirect()->route('activity.show', $activity->id);
        } else {
            flash('发布活动失败')->error();
            return back()->withInput();
        }
    }
}
