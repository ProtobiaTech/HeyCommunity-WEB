<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopicNode extends Node
{
    use SoftDeletes;

    // guarded
    protected $guarded = [];

    /**
     * Related TopicNode
     */
    public function childNodes()
    {
        return $this->hasMany('App\TopicNode', 'parent_id', 'id')->orderBy('lft');
    }

    /**
     * Related TopicNode
     */
    public function topics()
    {
        return $this->hasMany('App\Topic', 'node_id');
    }
}
