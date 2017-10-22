<?php

namespace App\Http\Middleware;

use Closure;
use Auth, Session;
class CheckNotifications
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
        if(Auth::user() && Auth::user()->hasRole('client')){
            if(Auth::user()->newnotifications){
                Session::flash('alerts',Auth::user()->newnotifications);
            }
        }
        return $next($request);
    }
}
