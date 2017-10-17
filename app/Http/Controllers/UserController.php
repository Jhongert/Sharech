<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Image;

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
        
    }

    public function profile(){
        return view('profile');
    }

    public function imageUpload(Request $request){
        // Validate image file
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the file
         $image = $request->file('image');

        // Get current user
        $user = \Auth::User();

        // Array of default avatar
        $avatar = array('blank.jpg', 'missing.jpg', 'default.jpg' );

        // Check if current user has a default avatar
        // If true, create a new name for the avatar
        // If false, use the same name for the avatar and replace the current picture
        //if(in_array($user->avatar, $avatar)){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        //} else{
        //    $input['imagename'] = $user->avatar;
       //}
     
   
        $destinationPath = public_path('/avatar');
        $img = Image::make($image->getRealPath());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);


        
        
        $user->avatar = $input['imagename'];
        $user->save();

        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
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
