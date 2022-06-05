<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CkeckClassName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->checkroll <= 25) {
            return redirect('about');
        }
        return $next($request);
    }
}
