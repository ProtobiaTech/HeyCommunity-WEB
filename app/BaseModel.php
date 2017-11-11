<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BaseModel extends Model
{
    // guarded
    protected $guarded = [];

    /**
     * Relation User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Mine Scope
     */
    public function scopeMine($query)
    {
        return $query->where(['user_id' => Auth::id()]);
    }

}
