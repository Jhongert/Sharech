<?php

namespace App\Http\Controllers;

use App\Comment;

use Validator;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        /**
         * Protect all routes but not index and show
         * All users can see posts
         * Only authenticated users can create, store, edit, update and destroy posts
         */        
        $this->middleware('auth', ['except' => ['index', 'show']]);
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'content' => 'required',
            'post_id' => 'required'
        ]);

        
        if ($validator->fails()){
            return 'error';
        } else {

            $comment = new Comment;

            $comment->content = $request->content;
            $comment->post_id = $request->post_id;
            $comment->user_id = \Auth::User()->id;

            $comment->save();
            
            $userName = \Auth::User()->name;
            return $userName;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
