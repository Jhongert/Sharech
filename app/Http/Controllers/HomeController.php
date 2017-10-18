<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check())
        {
            $user_id = \Auth::User()->id;

            $posts = \App\Post::with('user')
                ->where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')->get();

            return view('home',['posts' => $posts]);

        } else {
            return view('home');
        }
        
    }
}
