<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRollno
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
        if ($request->check <= 25) {
            return redirect('awad');
        }
        return $next($request);
    }
}
