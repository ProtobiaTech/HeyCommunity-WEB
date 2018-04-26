<?php

namespace App\Http\Middleware;

use Auth;
use Agent;
use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateWithWechat
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strpos(Agent::getUserAgent(), 'MicroMessenger') !== false) {
            $user = session('wechat.oauth_user');
            if ($this->auth->guest() || Auth::user()->wx_open_id !== $user->id) {
                $user = User::where(['wx_open_id' => $user->id])->first();
                if (!$user) {
                    $user = session('wechat.oauth_user');
                    $userInfo['wx_open_id'] =  $user->id;
                    $userInfo['nickname']   =  $user->nickname;
                    // $userInfo['avatar']     =  $this->saveAvatar($user);
                    $userInfo['avatar']     =  $user->avatar;

                    $user = User::firstOrCreate($userInfo);
                }

                Auth::login($user);
            }
        }

        return $next($request);
    }

    public function saveAvatar($user)
    {
        $path = 'uploads/avatars/' . $user->id . '.jpg';

        ini_set('default_socket_timeout', 1);
        $content = file_get_contents($user->avatar);
        file_put_contents($path, $content);

        return $path;
    }
}
