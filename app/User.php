<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    //
    protected $guarded = [];

    /**
     * Genders
     */
    public static $genders = [
        1   =>      '男',
        2   =>      '女',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Guest Avatar
     */
    public static function guestAvatar()
    {
        return '/images/user/avatars/guest.jpg';
    }

    /**
     * Get Avatar Attribute
     */
    public function getAvatarAttribute($value)
    {
        return asset($value);
    }
}
