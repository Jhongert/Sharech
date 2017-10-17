<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

//use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

     public function show($name)
    {
        $user = \App\User::where('name', '=', $name)->firstOrFail();


        $posts = \App\Post::with('user')
                ->where('published', '=', '1')
                ->where('user_id', '=', $user->id)
                ->orderBy('created_at', 'desc')->get();

        return view('posts',['posts' => $posts]);
    }
}
