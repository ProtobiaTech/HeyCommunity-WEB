<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TopicNode;

class TopicNodeController extends Controller
{
    /**
     * Topic Node list page
     */
    public function index()
    {
        $rootNodes = TopicNode::roots()->get();

        return view('admin.topic.node', compact('rootNodes'));
    }
}
