<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use App\Topic;
use App\TopicComment;
use App\TopicCommentThumb;

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
            'floor_number'  =>      $topic->comments()->withTrashed()->count() + 1,
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
     * Destroy Topic Comment
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

    /**
     * Reply Topic Comment
     */
    public function reply(Request $request)
    {
        $this->validate($request, [
            'parent_id'         =>  'required|integer',
            'content'           =>  'required|string',
        ]);

        $parentTopicComment = TopicComment::find($request->parent_id);
        if ($parentTopicComment) {
            $data = $request->only(['parent_id', 'content']);
            $data['root_id']        =   $parentTopicComment->root_id ?: $parentTopicComment->id;
            $data['topic_id']       =   $parentTopicComment->topic_id;
            $data['floor_number']   =   $parentTopicComment->topic->comments()->count() + 1;
            $data['user_id']        =   Auth::id();
            $topicComment = TopicComment::create($data);
            $topicComment->topic->increment('comment_num');

            // trigger notice
            event(new \App\Events\TopicNotice('TopicCommentReplay', $topicComment, $parentTopicComment->user_id, $topicComment->user_id));

            flash('回复成功')->success();
            return back();
        } else {
            flash('回复失败')->error();
            return back();
        }
    }

    /**
     * Topic Comment Thumb
     */
    public function thumb(Request $request)
    {
        $this->validate($request, [
            'topic_comment_id'  =>  'required|integer',
            'type'              =>  'required|string',
        ]);

        $topicComment = TopicComment::findOrFail($request->topic_comment_id);
        if ($topicComment->userThumb) {
            $typeId = TopicCommentThumb::$types[$request->type];

            if ($typeId != $topicComment->userThumb->type_id) {
                $topicComment->userThumb->toggleThumb();
            } else {
                $topicComment->userThumb->deleteThumb();
            }
        } else {
            TopicCommentThumb::createThumb($topicComment, $request->type);
        }

        return back();
    }
}
