<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Topic;
use App\TopicNode;
use App\TopicThumb;
use App\TopicFavorite;
use Illuminate\Support\Facades\Input;

class TopicController extends Controller
{
    /**
     * Topic List Page And Search
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

        if (Input::get('q') !== null) {
            $topics = $query->where('title', 'like', '%'.Input::get('q').'%')->
            latest()->paginate(10);

        } else {
            $topics = $query->latest()->paginate(10);
        }
        $rootNodes = TopicNode::roots()->with('childNodes')->get();

        return view('topic.index', compact('topics', 'rootNodes'));
    }

    /**
     * Show a topic
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->increment('read_num');

        return view('topic.show', compact('topic'));
    }

    /**
     * Create topic page
     */
    public function create()
    {
        $rootNodes = TopicNode::roots()->with('childNodes')->get();

        return view('topic.create', compact('rootNodes'));
    }

    /**
     * Store topic
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>      'required|string',
            'node_id'       =>      'required|integer',
            'content'       =>      'required|string|min:10',
        ]);

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->content = clean($request->content);
        $topic->node_id = $request->node_id;
        $topic->user_id = Auth::id();

        if ($topic->save()) {
            return redirect()->route('topic.show', $topic->id);
        } else {
            return back()->withInput();
        }
    }

    /**
     * Topic Thumb
     */
    public function thumb(Request $request)
    {
        $this->validate($request, [
            'topic_id'      =>  'required|integer',
            'type'          =>  'required|string',
        ]);

        $topic = Topic::findOrFail($request->topic_id);
        if ($topic->userThumb) {
            $typeId = TopicThumb::$types[$request->type];

            if ($typeId != $topic->userThumb->type_id) {
                $topic->userThumb->toggleThumb();
            } else {
                $topic->userThumb->deleteThumb();
            }
        } else {
            TopicThumb::createThumb($topic, $request->type);
        }

        return back();
    }

    /**
     * Topic Favorite
     */
    public function favorite(Request $request)
    {
        $this->validate($request, [
            'topic_id'      =>  'required|integer',
        ]);

        $topic = Topic::findOrFail($request->topic_id);
        if ($topic->userFavorite) {
            $topic->userFavorite->deleteFavorite();
        } else {
            flash('收藏成功')->success();
            TopicFavorite::createFavorite($topic);
        }

        return back();
    }

    /**
     * Topic Edit Page
     */
    public function edit($id)
    {
        $rootNodes = TopicNode::roots()->with('childNodes')->get();
        $topic = Topic::findOrFail($id);

        if (Gate::allows('update-within-time', $topic)) {
            return view('topic.edit', compact('rootNodes', 'topic'));
        } else {
            return back();
        }
    }

    /**
     * Topic Update Handle
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>      'required|string',
            'node_id'       =>      'required|integer',
            'content'       =>      'required|string|min:10',
        ]);

        $topic = Topic::findOrFail($id);

        if (Gate::allows('update-within-time', $topic)) {
            $topic->update($request->only(['title', 'node_id', 'content']));

            return redirect()->route('topic.show', $topic->id);
        } else {
            return back();
        }
    }

    /**
     * Topic Destroy
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        $topic = Topic::findOrFail($request->id);

        if (Gate::allows('update', $topic)) {
            $topic->delete();

            flash('操作成功')->success();
            return redirect()->route('topic.index');
        } else {
            flash('操作失败, 你无权执行此操作')->error();
            return back();
        }
    }
}
