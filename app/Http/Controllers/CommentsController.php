<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
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


    public function addComment(Request $request){
        $userid = Auth::user()->id;
        $postid = $request->postid;
        $comment_body = $request->comment_body;

        if($comment_body != ''){
            $addComment = New Comment;
            $addComment->content = $comment_body;
            $addComment->userid = $userid;
            $addComment->postid = $postid;
            $addComment->save();
        }

        return view('profile');
    }
}
