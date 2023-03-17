<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;

class NewsFeedController extends Controller
{
    public function newsfeed(){

        $userid = Auth::user()->id;

        //Get User Posts
        $GetUserPosts = DB::table('posts')
            ->select('posts.id', 'posts.userid', 'posts.content', 'postpics.imgname','users.fname', 'users.lname', 'users.profpic')
            ->leftJoin('postpics', 'postpics.postid', '=', 'posts.id')
            ->leftJoin('users', 'users.id', '=', 'posts.userid')
            ->orderBy('posts.id', 'DESC')
            ->get();
        //Get User Comments
        $GetUserComments = DB::table('comments')
            ->select('comments.id', 'comments.content', 'comments.userid', 'comments.postid', 'users.fname', 'users.lname', 'users.profpic')
            ->leftJoin('posts', 'posts.id', '=', 'comments.postid')
            ->leftJoin('users', 'users.id', '=', 'comments.userid')
            ->orderBy('comments.id', 'ASC')
            ->get();
        
        $GetUserInfo = DB::table('users')->where('id', '=' ,$userid)->get();

        return view('newsfeed', compact('GetUserPosts', 'GetUserComments', 'GetUserInfo'));
    }
}
