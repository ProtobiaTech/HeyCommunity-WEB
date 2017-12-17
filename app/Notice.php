<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends BaseModel
{
    /**
     * Related sender user
     */
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    /**
     * Readted entity
     */
    public function entity()
    {
        return $this->belongsTo($this->entity_class, 'entity_id')->withTrashed();
    }

    /**
     * Unread Scope
     */
    public function scopeUnread($query)
    {
        return $query->where(['is_read' => false]);
    }
}
