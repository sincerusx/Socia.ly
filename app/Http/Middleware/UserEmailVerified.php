<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class UserEmailVerified
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
        if(!auth()->user()->verified_email){
            Session::flush();
            return redirect('/')->with('Please verify your email address to access this area.');
        }

        return $next($request);
    }
}
