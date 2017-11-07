<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class TopicNode extends Node
{
    /**
     * Related TopicNode
     */
    public function childNodes()
    {
        return $this->hasMany('App\TopicNode', 'parent_id', 'id');
    }

    /**
     * Related TopicNode
     */
    public function topics()
    {
        return $this->hasMany('App\Topic', 'node_id');
    }
}
