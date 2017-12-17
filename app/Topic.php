<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    /**
     * Related TopicComment
     */
    public function rootComments()
    {
        return $this->hasMany('App\TopicComment', 'topic_id')->whereNull('root_id')->latest();
    }

    /**
     * Related TopicComment
     */
    public function comments()
    {
        return $this->hasMany('App\TopicComment', 'topic_id')->latest();
    }

    /**
     * Relation TopicThumb
     */
    public function userThumb($userId = null)
    {
        $userId = $userId ?: Auth::id();

        return $this->hasOne('App\TopicThumb', 'topic_id')->where(['user_id' => $userId]);
    }

    /**
     * Relation TopicFavorite
     */
    public function userFavorite($userId = null)
    {
        $userId = $userId ?: Auth::id();

        return $this->hasOne('App\TopicFavorite', 'topic_id')->where(['user_id' => $userId]);
    }

    /**
     * Get is user thumb up
     */
    public function getIsUserThumbUpAttribute()
    {
        if ($this->userThumb()->exists()) {
            return $this->userThumb->type_id == TopicThumb::$types['thumb_up'];
        }

        return false;
    }

    /**
     * Get is user thumb up
     */
    public function getIsUserThumbDownAttribute()
    {
        if ($this->userThumb()->exists()) {
            return $this->userThumb->type_id == TopicThumb::$types['thumb_down'];
        }

        return false;
    }

    /**
     * Get is user thumb up
     */
    public function getIsUserFavoriteAttribute()
    {
        return $this->userFavorite()->exists();
    }
}
