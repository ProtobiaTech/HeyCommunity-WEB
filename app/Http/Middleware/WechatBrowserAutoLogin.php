<?php

namespace App\Http\Middleware;

use Closure;
use Agent;

class WechatBrowserAutoLogin
{
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
            return redirect()->route('user.login-by-wechat');
        }

        return $next($request);
    }
}
