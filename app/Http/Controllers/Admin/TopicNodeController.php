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

    /**
     * Topic Node to left
     */
    public function nodeToLeft(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        $node = TopicNode::findOrFail($request->id);
        $node->moveLeft();

        flash('操作成功')->success();
        return back();
    }

    /**
     * Topic Node to right
     */
    public function nodeToRight(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        $node = TopicNode::findOrFail($request->id);
        $node->moveRight();

        flash('操作成功')->success();
        return back();
    }
}
