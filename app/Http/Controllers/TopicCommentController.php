<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Topic;

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
            'content'       =>      $request->content,
            'floor_number'  =>      $topic->comments()->count() + 1,
        ];
        $topicComment = $topic->comments()->create($commentInfo);

        if ($topicComment) {
            $topic->increment('comment_num');

            return redirect()->route('topic.show', $topic->id);
        } else {
            return back()->withInput();
        }
    }
}
