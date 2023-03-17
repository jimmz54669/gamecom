<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\Gameappcomment;
use App\Favorategame;

class GameappCommentController extends Controller
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

    public function AddGameAppComment(Request $request){

        $userid = Auth::user()->id;
        $comment = $request->gameappcomment; //$_POST['comment']
        $id = $request->gameappid;
        
        $GetGameApp = DB::table('gameapps')->where('id', '=', $id)->get(); 

        $AddComment = new Gameappcomment;
        $AddComment->content = $comment;
        $AddComment->userid = $userid;
        $AddComment->gameappid = $id;
        $AddComment->save();

    }//End of Function


    public function AddGameAppToFavorates(Request $request){
        $userid = Auth::user()->id;
        $gameappid = $request->gameappid;

        if(!Favorategame::where('gameappid','=', $gameappid)->exists()){
            $AddToFavorites = New Favorategame;
            $AddToFavorites->userid = $userid;
            $AddToFavorites->gameappid = $gameappid;
            $AddToFavorites->save();
        }

    }//End of Function



    public function DeleteFavoriteGame(Request $request){
        $userid = Auth::user()->id;
        $gameappid = $request->gameappid;

        Favorategame::where('gameappid', '=', $gameappid)
        ->where('userid', '=', $userid)
        ->delete();
    }


}//End Class
