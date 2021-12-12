<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateBackend
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
        $token = $request->get('token');

        if ($token == null && $token != '8669') {
            return redirect()->guest('/');
        }

        return $next($request);
    }
}
