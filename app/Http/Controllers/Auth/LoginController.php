<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     * @return \Illuminate\Http\RedirectResponse
     */

    protected function authenticated($request, $user)
    {
        if($user->role === 'lecturer') {
            Auth::login($user);
            return redirect()->intended('/lecturer');
        }
        elseif ($user->role === 'student'){
            Auth::login($user);
            return redirect()->intended('/student');
        }
        elseif ($user->role === 'admin'){
            Auth::login($user);
            return redirect()->intended('/admin');

        }
        elseif ($user->role === 'moderator'){
            Auth::login($user);
            return redirect()->intended('/moderator');

        }
        else
            return redirect()->intended('/login');
    }
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
