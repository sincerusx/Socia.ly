<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Session;

class UserEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @param \App\Models\User          $user
     *
     * @return mixed
     */
    public function handle($request, Closure $next, User $user)
    {
        if(!auth()->user()->verified_email){
            Session::flush();
            return redirect('/')->with('Please verify your email address to access this area.');
        }

        return $next($request);
    }
}
