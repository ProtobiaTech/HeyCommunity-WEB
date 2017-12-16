<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use App\Topic;
use App\TopicComment;

class TopicCommentController extends Controller
{
    /**
     * Store topic comment
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'topic_id'      =>      'required|integer',
            'content'       =>      'required|string|min:3',
        ]);

        $topic = Topic::findOrFail($request->topic_id);

        $commentInfo = [
            'topic_id'      =>      $topic->id,
            'user_id'       =>      Auth::id(),
            'content'       =>      clean($request->content),
            'floor_number'  =>      $topic->comments()->count() + 1,
        ];
        $topicComment = $topic->comments()->create($commentInfo);

        if ($topicComment) {
            $topic->increment('comment_num');

            // trigger notice
            event(new \App\Events\TopicNotice('TopicComment', $topicComment, $topic->user_id, $topicComment->user_id));

            return redirect()->route('topic.show', $topic->id);
        } else {
            return back()->withInput();
        }
    }

    /**
     *
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'        =>      'required|integer',
        ]);

        $topicComment = TopicComment::findOrFail($request->id);

        if (Gate::allows('update-within-time', $topicComment)) {
            $topicComment->delete();
            $topicComment->topic->decrement('comment_num');

            flash('操作成功')->success();
            return back();
        } else {
            return back();
        }
    }
}
