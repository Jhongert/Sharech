<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PostController extends Controller
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
        return view('posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*DB::table('posts')->insert(
            ['title' => $request->title,
             'content' => $request->content,
             'user_id' => \Auth::User()->id
            ]
        );*/

        /*DB::beginTransaction();
        try{
            $post = new Post;
        
            $post->title = $request->title;
            $post->content = $request->content;
            $post->published = ($request->published == "true") ? 1 : 0;
            $post->user_id = \Auth::User()->id;
            $post->save();

            $tags = array();
            foreach($request->tags as $name) {
              array_push($tags, array("post_id" => $post->id, "name" => $name));
            }

            $tag = new Tag;
            $tag::insert($tags);

            DB::commit();
            return 'ok';
        } catch(Exception $e) {
            DB::rollback();
            return 'error';
        }*/

        return 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
