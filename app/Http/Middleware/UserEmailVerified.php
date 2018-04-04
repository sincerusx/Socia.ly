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
        if (!!auth()->user() && 0 == auth()->user()->verified_email) {
            Session::flash('verify', $this->message());

            return $next($request);
        }

        return $next($request);
    }

    /**
     * @return string
     */
    private function message()
    {
        return '<span>You must verify your email address to access this area. Please ' . $this->anchorTag() . ' to resend the verification email</span>';
    }

    /**
     * @return string
     */
    private function anchorTag()
    {
        return '<a href="' . route('auth.verify.resend') . '">click here</a>';
    }
}
