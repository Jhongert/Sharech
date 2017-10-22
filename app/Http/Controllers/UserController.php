<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Image;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\Filesystem\Filesystem;
use Storage;

//$s3 = \Storage::disk('s3');

//require ('../vendor/autoload.php');

//$s3 = Aws\S3\S3Client::factory();

//$bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET" config var in found in env!');

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

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'oldPassword' => 'bail|required',
            'password' => 'bail|required|string|min:6|confirmed'
        ]);

        if ($validator->fails()){
             return redirect('user/profile')
                        ->withErrors($validator);
        } else {
            $user = \Auth::User();
            if (Hash::check($request->oldPassword, $user->password)){
                $user->password = Hash::make($request->password);
                $user->save();

                return back()
                    ->with('passwordOk','Your password has been changed.');
            } else {
                return back()
                    ->with('wrongPassword','Your old password is not valid.');
            }

        }
    }

    public function imageUpload(Request $request, Filesystem $filesystem){
        // Validate image file
        $this->validate($request, [
            'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the file
        $image = $request->file('image')->store(
            'avatar', 's3'
        );

         return back()
            ->with('uploaded','Image Upload successful');

        // Get current user
        $user = \Auth::User();


        $imagename = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = public_path('/avatar/' . $imagename);

        $img = Image::make($image->getRealPath());


        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->putFile('avatar',$img);

        return back()
            ->with('uploaded','Image Upload successful');


        $upload = $s3->upload($bucket, $imagename, $img, 'rb', 'public-read');
        //->save($destinationPath . $input['imagename']);
        
        $user->avatar = $imagename;
        $user->save();

        return back()
            ->with('uploaded','Image Upload successful');
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
