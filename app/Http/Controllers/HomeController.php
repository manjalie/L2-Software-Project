<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'student')
        {
            return redirect('student');
        }
        elseif (Auth::user()->role == 'lecturer')
        {
            return redirect('lecturer');
        }
        elseif (Auth::user()->role == 'moderator')
        {
            return redirect('moderator');
        }
        elseif (Auth::user()->role == 'admin')
        {
            return redirect('admin');
        }
        return view('login');
    }
}
