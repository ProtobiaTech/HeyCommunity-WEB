<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public static function guestAvatar()
    {
        return '/images/user/avatars/guest.jpg';
    }
}
