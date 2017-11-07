<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\TopicNode;

class TopicController extends Controller
{
    /**
     * Topic List Page
     */
    public function index()
    {
        $topics = Topic::paginate();
        $rootNodes = TopicNode::roots()->with('childNodes')->get();

        return view('topic.index', compact('topics', 'rootNodes'));
    }

    /**
     *
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);

        return view('topic.show', compact('topic'));
    }
}
