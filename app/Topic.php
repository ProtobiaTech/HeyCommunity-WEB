<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends BaseModel
{
    /**
     * Related User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Related TopicNode
     */
    public function node()
    {
        return $this->belongsTo('App\TopicNode', 'node_id');
    }
}
