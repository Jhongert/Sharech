<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Comment;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = \App\Post::with('user')->where('published', '=', '1')->orderBy('created_at', 'desc')->get();

        return view('posts',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = array('id' => '', 'title' => '', 'content' => '', 'description' => '', 'tags' => [], 'published' => false);

        return view('createpost', ['post' => (object) $post]);
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
            'title' => 'bail|required|unique:posts|max:56',
            'content' => 'required',
            'description' => 'required'
        ], [
            'title.unique' => 'This title already exist'
        ]);

        if ($validator->fails()){
            return $validator->errors()->first();
        } else {

            $post = new Post;
            
            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->content;
            $post->published = ($request->published == "true") ? 1 : 0;
            $post->url = strtolower(str_replace(" ", "-",$request->title));
            $post->user_id = \Auth::User()->id;

            DB::beginTransaction();
            try{
                
                $post->save();

                $tags = array();
                
                if (count($request->tags) > 0){
                    foreach($request->tags as $name) {
                        array_push($tags, array("post_id" => $post->id, "name" => $name));
                    }
                    $tag = new Tag;
                    $tag::insert($tags);
                }

                DB::commit();
                return 'ok';
            } catch(Exception $e) {
               DB::rollback();
                return 'error';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $post = \App\Post::with(['tags', 'user'])->where('url', '=', $url)->firstOrFail();

        $comments = \App\Comment::with('user')->where('post_id', '=', $post->id)->get();

        $rand = rand(0,count($post->tags) - 1);
        $randTag = $post->tags[$rand]->name;

        $related = \App\Post::whereHas('tags', function($q) use ($randTag){
            $q->where('name', '=', $randTag);
        })
            ->where([['published', '=', '1'],['id', '<>', $post->id]])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get(['title', 'url']);

        return view('post', array('post' => $post,
                    'comments' => $comments, 
                    'related' => $related));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Post::with('tags')->where('id', '=', $id)->firstOrFail();

        $user_id = \Auth::User()->id;

         if($post->user_id != $user_id){
             return abort(401);
         }
        return view('createpost', ['post' =>  $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'bail|required|max:56',
            'content' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()){
            return 'validator';
        } else {

            // get the post that we want to update
            $post = Post::find($id);

            // Verify that the user loged in is the woner of this post
            // If is not, then abort with a 401
            $user_id = \Auth::User()->id;
            if($post->user_id != $user_id){
                return abort(401);
            }

            // Set the values
            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->content;
            $post->published = ($request->published == "true") ? 1 : 0;
            $post->url = strtolower(str_replace(" ", "-",$request->title));
            $post->user_id = \Auth::User()->id;


            // Begin transaction
            DB::beginTransaction();
            try{
                
                // Save the post
                $post->save();

                // Delete the existing tags form database
                $deletedRows = Tag::where('post_id', '=', $id)->delete();

                // If there are tags, create an array of tags and insert to the database
                $tags = array();
                
                if (count($request->tags) > 0){
                    foreach($request->tags as $name) {
                        array_push($tags, array("post_id" => $post->id, "name" => $name));
                    }

                    $tag = new Tag;
                    $tag::insert($tags);
                }

                DB::commit();
                return 'ok';
            } catch(Exception $e) {
               DB::rollback();
                return 'catch';
            }
        } 
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

    public function search($term){
        $posts = \App\Post::where('title', 'like', '%' . $term . '%')
            ->where('published', '=', '1' )
            ->take(8)
            ->get(['title', 'url']);
        return $posts->toJson();
    }
}
