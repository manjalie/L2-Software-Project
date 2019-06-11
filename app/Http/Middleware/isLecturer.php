<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isLecturer
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
        if (Auth::check()) {
            if (auth()->User()->isActive() && auth()->User()->isLecturer()) {

                return $next($request);
            }

            if (!auth()->User()->isActive())
            {
                return redirect('blocked');
            }
        }
        return redirect('login');
    }
}
