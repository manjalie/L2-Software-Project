<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (!auth()->User()->isActive()) {
                return redirect('/blocked');
            }
            elseif (auth()->User()->isLecturer()) {
                return redirect('/lecturer');
            }
            elseif (auth()->User()->isStudent()) {
                return redirect('/student');
            }
            elseif (auth()->User()->isModerator()) {
                return redirect('/moderator');
            }
            elseif (auth()->User()->isAdmin()) {
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
