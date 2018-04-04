<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Closure;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next){
        if (
                $this->isReading($request) ||
                $this->runningUnitTests() ||
                $this->inExceptArray($request) ||
                $this->tokensMatch($request) ||
                $this->isPostman()
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }

    public function isPostman(){

        $localhost = ['127.0.0.1', '127.0.0.1:8000', '::1'];

        if(false === in_array($_SERVER['REMOTE_ADDR'], $localhost))
            return false;

        if(false === in_array($_SERVER['SERVER_NAME'], $localhost))
            return false;

        if(false === in_array($_SERVER['HTTP_HOST'], $localhost))
            return false;


        return isset($_SERVER['HTTP_POSTMAN_TOKEN']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'PostmanRuntime') !== false) ? true : false;
    }
}
