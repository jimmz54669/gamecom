<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $GetAllProducts = DB::table('products')->limit(3)->get();
           
        return view('home', compact('GetAllProducts'));
    }

    public function about()
    {
        return view('about');
    }

    public function shop()
    {
        $GetAllProducts = DB::table('products')->get();
        $GetCategories = DB::table('categories')->get();
        return view('shop', compact('GetCategories', 'GetAllProducts'));
    }

    

    public function games()
    {
        $GameApps = DB::table('gameapps')->get();
        return view('games', compact('GameApps'));
    }



    public function Search(Request $request){
        $keysearch = $request->keysearch;
        
        // link, searchimg, stringsearch

        $GetAllProducts = DB::table('products')
        ->select(DB::raw("CONCAT('/placeorder/',id) as link"), 'prodname as stringsearch', 'prodimg as searchimg')
        ->where('prodname', 'LIKE', '%'.$keysearch.'%')
        ->get();

        $GetUsersLists = DB::table('users')
        ->select(DB::raw("CONCAT('/viewprofile/',id) as link"), DB::raw("CONCAT(fname, ', ', lname) AS stringsearch"), 'profpic as searchimg')
        ->where('fname', 'LIKE', '%'.$keysearch.'%')
        ->orWhere('lname', 'LIKE', '%'.$keysearch.'%')
        ->get();

        $GetGamelists = DB::table('gameapps')
        ->select(DB::raw("CONCAT('/gamepage/',id) as link"), 'gameappname as stringsearch', 'gamepic as searchimg')
        ->where('gameappname', 'LIKE', '%'.$keysearch.'%')
        ->get();


        $searchlist = array_merge($GetAllProducts->toArray(), $GetUsersLists->toArray(), $GetGamelists->toArray());

       

        return response()->json($searchlist);
    }

    


}//End Class
