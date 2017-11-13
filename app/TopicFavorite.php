<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class TopicFavorite extends BaseModel
{
    /**
     * Relation topic
     */
    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

    /**
     * Delete Favorite
     */
    public function deleteFavorite()
    {
        DB::transaction(function () {
            $this->delete();
            $this->topic->decrement('favorite_num');
        });
    }

    /**
     * Create Favorite
     */
    public static function createFavorite($topic)
    {
        DB::transaction(function () use ($topic) {
            TopicFavorite::create([
                'topic_id'      =>  $topic->id,
                'user_id'       =>  Auth::id(),
            ]);

            $topic->increment('favorite_num');
        });
    }
}
