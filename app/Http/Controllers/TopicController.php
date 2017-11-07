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
    public function index(Request $request)
    {
        $query = Topic::query();

        // node condition
        if ($request->node) {
            $node = TopicNode::where(['name' => $request->node])->first();

            if ($node->parent) {
                $nodeIds = [$node->id];
            } else {
                $nodeIds = $node->childNodes()->pluck('id');
            }

            $query->whereIn('node_id', $nodeIds);
        }

        // filter
        if ($request->filter) {
            switch ($request->filter) {
                case 'recent':
                    $query->orderByDesc('updated_at');
                    break;
                case 'hot':
                    $query->orderByDesc('comment_num', 'read_num', 'updated_at');
                    break;
                case 'excellent':
                    // @todo
                    break;
                case 'noreply':
                    $query->where(['comment_num' => 0])->orderByDesc('updated_at');
                    break;
                default:
                    break;
            }
        }

        $topics = $query->latest()->paginate(10);
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
