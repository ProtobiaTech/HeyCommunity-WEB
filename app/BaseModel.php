<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BaseModel extends Model
{
    // guarded
    protected $guarded = [];

    /**
     * Mine Scope
     */
    public function scopeMine($query)
    {
        return $query->where(['user_id' => Auth::id()]);
    }

}
