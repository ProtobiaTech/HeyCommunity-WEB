<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TopicComment extends BaseModel
{
    /**
     * Related topic
     */
    public function topic()
    {
        return $this->belongsTo('\App\Topic', 'topic_id')->withTrashed();
    }

    /**
     * Related TopicComment
     */
    public function parent()
    {
        return $this->belongsTo('App\TopicComment', 'parent_id')->withTrashed();
    }

    /**
     * Related TopicComment
     */
    public function childComments()
    {
        return $this->hasMany('App\TopicComment', 'root_id')->latest();
    }

    /**
     * Relation TopicThumb
     */
    public function userThumb($userId = null)
    {
        $userId = $userId ?: Auth::id();

        return $this->hasOne('App\TopicCommentThumb', 'topic_comment_id')->where(['user_id' => $userId]);
    }
}
