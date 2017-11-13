<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class TopicThumb extends BaseModel
{
    /**
     * Types
     */
    public static $types = [
        'thumb_up'      =>      1,
        'thumb_down'    =>      2,
    ];

    /**
     * Relation topic
     */
    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

    /**
     * Toggle thumb
     */
    public function toggleThumb()
    {
        $topicThumbInfo = [
            'user_id'       =>  $this->user_id,
            'topic_id'      =>  $this->topic->id,
            'type_id'       =>  $this->type_id == 1 ? 2 : 1,
        ];

        DB::transaction(function () use ($topicThumbInfo) {
            $this->create($topicThumbInfo);
            $this->delete();

            if ($this->type_id == 1) {
                $this->topic->increment('thumb_down_num');
                $this->topic->decrement('thumb_up_num');
            } else {
                $this->topic->increment('thumb_up_num');
                $this->topic->decrement('thumb_down_num');
            }
        });
    }

    /**
     * Create thumb
     */
    public static function createThumb($topic, $type)
    {
        $typeId = TopicThumb::$types[$type];
        $topicField = $type . '_num';

        $topicThumbInfo = [
            'user_id'       =>  Auth::id(),
            'type_id'       =>  $typeId,
        ];

        DB::transaction(function () use ($topic, $topicThumbInfo, $topicField) {
            $topic->userThumb()->create($topicThumbInfo);
            $topic->increment($topicField);
        });
    }

    /**
     * Delete thumb
     */
    public function deleteThumb()
    {
        $typeName = $this->type_id == 1 ? 'thumb_up_num' : 'thumb_down_num';

        DB::transaction(function () use ($typeName) {
            $this->delete();
            $this->topic->decrement($typeName);
        });
    }
}
