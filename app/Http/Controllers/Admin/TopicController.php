<?php

namespace App\Http\Controllers\Admin;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Topic list page
     */
    public function index()
    {
        $topics = Topic::latest()->paginate();

        return view('admin.topic.index', compact('topics'));
    }
}
