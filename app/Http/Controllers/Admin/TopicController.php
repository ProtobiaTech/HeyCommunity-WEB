<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Topic list and search
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $topics = Topic::where('title', 'like', '%'. $request->q . '%')->paginate();
        } else {
            $topics = Topic::latest()->paginate();
        }

        return view('admin.topic.index', compact('topics'));
    }
}
