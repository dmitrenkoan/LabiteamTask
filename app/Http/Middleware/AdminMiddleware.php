<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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

        if($request->user() === NULL) {
            return redirect('login');
        }
        elseif($request->user()->is_admin == "Y") {
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
