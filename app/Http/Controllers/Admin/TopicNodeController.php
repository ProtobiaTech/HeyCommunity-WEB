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

    /**
     * Topic Node destroy
     */
    public function nodeDestroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        $node = TopicNode::findOrFail($request->id);

        if ($node->children->count()) {
            flash('操作失败, 请先删除该节点下的所有子节点')->error();
            return back();
        } else {
            if ($node->topics()->count()) {
                flash('操作失败, 请先删除该节点下的所有话题')->error();
                return back();
            }
        }

        $Node->delete();

        flash('操作成功');
        return back();
    }
}
