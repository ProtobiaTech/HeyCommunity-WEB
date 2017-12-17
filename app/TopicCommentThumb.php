<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class TopicCommentThumb extends BaseModel
{
    /**
     * Types
     */
    public static $types = [
        'thumb_up'      =>      1,
        'thumb_down'    =>      2,
    ];

    /**
     * Relation TopicComment
     */
    public function topicComment()
    {
        return $this->belongsTo('App\TopicComment', 'topic_comment_id');
    }

    /**
     * Relation topic
     */
    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

    /**
     * Create Thumb
     */
    public static function createThumb($topicComment, $type)
    {
        $typeId = TopicCommentThumb::$types[$type];
        $field = $type . '_num';

        $topicCommentThumbInfo = [
            'user_id'       =>  Auth::id(),
            'type_id'       =>  $typeId,
            'topic_id'      =>  $topicComment->topic_id,
        ];

        DB::transaction(function () use ($topicComment, $topicCommentThumbInfo, $field) {
            $topicComment->userThumb()->create($topicCommentThumbInfo);
            $topicComment->increment($field);
        });
    }

    /**
     * Delete Thumb
     */
    public function deleteThumb()
    {
        $typeName = $this->type_id == 1 ? 'thumb_up_num' : 'thumb_down_num';

        DB::transaction(function () use ($typeName) {
            $this->delete();
            $this->topicComment->decrement($typeName);
        });
    }

    /**
     * Toggle Thumb
     */
    public function toggleThumb()
    {
        $topicCommentThumbInfo = [
            'user_id'           =>  $this->user_id,
            'topic_id'          =>  $this->topic->id,
            'topic_comment_id'  =>  $this->topic_comment_id,
            'type_id'           =>  $this->type_id == 1 ? 2 : 1,
        ];

        DB::transaction(function () use ($topicCommentThumbInfo) {
            $this->create($topicCommentThumbInfo);
            $this->delete();

            if ($this->type_id == 1) {
                $this->topicComment->increment('thumb_down_num');
                $this->topicComment->decrement('thumb_up_num');
            } else {
                $this->topicComment->increment('thumb_up_num');
                $this->topicComment->decrement('thumb_down_num');
            }
        });
    }
}
