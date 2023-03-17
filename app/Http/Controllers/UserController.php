<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use DB;
use App\User;

class UserController extends Controller
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


    public function profile(){

        $userid = Auth::user()->id;
        
        $GetUserPosts = DB::table('posts')
            ->select('posts.id', 'posts.content', 'posts.userid', 'posts.created_at', 'posts.updated_at', 'postpics.imgname', 'users.fname', 'users.lname', 'users.birthday', 'users.username', 'users.email', 'users.profpic', 'users.coverpic')
            ->leftJoin('postpics', 'postpics.postid', '=', 'posts.id')
            ->leftJoin('users', 'users.id', '=', 'posts.userid')
            ->where('posts.userid', '=', $userid)
            ->orderBy('posts.id', 'DESC')
            ->get();
        
        $GetUserComments = DB::table('comments')
            ->select('comments.content', 'comments.userid', 'comments.postid', 'users.profpic', 'users.fname', 'users.lname')
            ->leftJoin('users', 'users.id', '=', 'comments.userid')
            ->leftJoin('posts', 'posts.id', '=', 'comments.postid')
            ->orderBy('comments.id', 'ASC')
            ->get();

        $GetUserInfo = DB::table('users')->where('id', '=' ,$userid)->get();

        $GetCartCount = DB::table('carts')->where('userid', '=', $userid)->count();

        return view('profile',compact('GetUserPosts', 'GetUserComments', 'GetUserInfo', 'GetCartCount'));
    }




    public function addProfPic(Request $request){

        $userid = Auth::user()->id;
        $profpic = $request->file('profpic');

        if($profpic != NULL || $profpic != ''){
        
            $image_name = rand(100, 999) . '.' . $profpic->getClientOriginalExtension();

            $destinationPath = public_path('/thumbnail');

            $resize_image = Image::make($profpic->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/images');

            $profpic->move($destinationPath, $image_name);
            
            $CheckProfPicExists = DB::table('users')->select('profpic')->where('id', '=',$userid)->get();
            foreach($CheckProfPicExists as $row){
                if($row->profpic != ''){
                    $destinationPath = public_path('/images');
                    File::delete($destinationPath.'/'.$row->profpic);

                    $destinationPath = public_path('/thumbnail');
                    File::delete($destinationPath.'/'.$row->profpic);
                }
            }

            $AddProfpic = User::where('id', '=', $userid)
            ->update(['profpic' => $image_name]);
        }

    }




    public function favorites(){

        $userid = Auth::user()->id;

        $GetFavoriteGames = DB::table('favorategames')
        ->leftJoin('gameapps', 'gameapps.id', '=', 'favorategames.gameappid')
        ->where('userid', '=', $userid)
        ->get();

        $GetCartCount = DB::table('carts')->where('userid', '=', $userid)->count();

        return view('favorites', compact('GetFavoriteGames', 'GetCartCount'));
    }


    

    public function viewProfile($id){
        
        $GetUserPosts = DB::table('posts')
            ->select('posts.id', 'posts.content', 'posts.userid', 'posts.created_at', 'posts.updated_at', 'postpics.imgname', 'users.fname', 'users.lname', 'users.birthday', 'users.username', 'users.email', 'users.profpic', 'users.coverpic')
            ->leftJoin('postpics', 'postpics.postid', '=', 'posts.id')
            ->leftJoin('users', 'users.id', '=', 'posts.userid')
            ->where('posts.userid', '=', $id)
            ->orderBy('posts.id', 'DESC')
            ->get();
        
        $GetUserComments = DB::table('comments')
            ->select('comments.content', 'comments.userid', 'comments.postid', 'users.profpic', 'users.fname', 'users.lname')
            ->leftJoin('users', 'users.id', '=', 'comments.userid')
            ->leftJoin('posts', 'posts.id', '=', 'comments.postid')
            ->orderBy('comments.id', 'ASC')
            ->get();

        $GetUserInfo = DB::table('users')->where('id', '=' ,$id)->get();

        return view('viewprofile',compact('GetUserPosts', 'GetUserComments', 'GetUserInfo'));

    }//End Function



    
    public function settings(){
        return view('settings');
    }

}//End class
