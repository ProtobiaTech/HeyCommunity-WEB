<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateWithAdmin
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
        if (Auth::check() && Auth::user()->is_super_admin) {
            return $next($request);
        } else {
            flash('您不是超级管理员无权访问')->error();
            return redirect()->route('user.login');
        }
    }
}
