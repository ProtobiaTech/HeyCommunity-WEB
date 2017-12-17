<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function childComments()
    {
        return $this->hasMany('App\TopicComment', 'root_id')->latest();
    }
}
