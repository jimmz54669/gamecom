<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;


class GameappController extends Controller
{

    public function gamepage($id){
        $GetGameApp = DB::table('gameapps')->where('id', '=', $id)->get();
        //SELECT * FROM gameapps WHERE id = $id
        
        $GetGameAppComment = DB::table('gameappcomments')
        ->select('gameappcomments.id', 'gameappcomments.content', 'gameappcomments.userid', 'gameappcomments.gameappid','users.fname', 'users.lname', 'users.profpic')
        ->leftJoin('users', 'users.id', '=', 'gameappcomments.userid')
        ->where('gameappcomments.gameappid', '=', $id)
        ->get();
        //SELECT `gameappcomments`.`id`, `gameappcomments`.`content`, `gameappcomments`.`userid`, `gameappcomments`.`gameappid`,`users`.`fname`, `users`.`lname`, `users`.`profpic`
        //FROM gameappcomments LEFT JOIN users ON `users`.`id`  = `gameappcomments`.`userid`
        //WHERE `gameappcomments`.`gameappid` = $id

        return view('gamepage', compact('GetGameApp', 'GetGameAppComment'));
    }

}
