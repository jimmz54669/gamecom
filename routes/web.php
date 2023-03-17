<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('shop', 'HomeController@shop')->name('shop');
Route::get('search', 'HomeController@Search')->name('search');


Route::get('order', 'OrdersController@GetOrderLists')->name('order');
Route::get('orderdetails/{orderid}', 'OrdersController@GetOrderDetails')->name('orderdetails');

Route::post('addtocart', 'OrdersController@AddtoCart')->name('addtocart');
Route::get('cart', 'OrdersController@GetCartLists')->name('cart');
Route::post('updatecartqty', 'OrdersController@UpdateCartQty')->name('updatecartqty');
Route::post('deletecartitem', 'OrdersController@DeleteCartItem')->name('deletecartitem');
Route::post('addorder', 'OrdersController@AddOrder')->name('addorder'); //For Individual Item
Route::post('addordercart', 'OrdersController@AddOrderCart')->name('addordercart');// For Order Place In Cart Lists
Route::get('processSuccess','OrdersController@processSuccess')->name('processSuccess');
Route::get('processCancel','OrdersController@processCancel')->name('processCancel');




Route::get('settings', 'UserController@settings')->name('settings');
Route::get('profile', 'UserController@profile')->name('profile');
Route::post('addprofpic', 'UserController@addProfpic')->name('addprofpic');
Route::get('newsfeed', 'NewsFeedController@newsfeed')->name('newsfeed');
Route::get('viewprofile/{id}', 'UserController@viewProfile')->name('viewprofile');


Route::post('addpost', 'PostController@addPost')->name('addpost');
Route::post('editpost', 'PostController@editPost')->name('editpost');
Route::post('deletepost', 'PostController@deletePost')->name('deletepost');
Route::post('addcomment', 'CommentsController@addComment')->name('addcomment');


Route::get('fetchmessages/{fromuserid}/{touserid}', 'MessagesController@FetchUserMessages')->name('fetchmessages');
Route::get('getmessages', 'MessagesController@GetUserMessages')->name('getmessages');
Route::post('sendmessage', 'MessagesController@SendMessage')->name('sendmessage');
Route::get('directmessage/{touserid}', 'MessagesController@DirectMessage')->name('directmessage');
Route::get('fetchdirectmessage/{touserid}', 'MessagesController@FetchDirectMessage')->name('fetchdirectmessage');


Route::get('games', 'HomeController@games')->name('games');
Route::get('gamepage/{id}', 'GameappController@gamepage')->name('gamepage');
Route::post('addgameappcomment', 'GameappCommentController@AddGameAppComment')->name('addgameappcomment');
Route::post('addgameapptofavorites', 'GameappCommentController@AddGameAppToFavorates')->name('addgameapptofavorites');
Route::post('deletefavoritegame', 'GameappCommentController@DeleteFavoriteGame')->name('deletefavoritegame');
Route::get('favorites', 'UserController@favorites')->name('favorites');


Route::post('addproduct', 'ProductsController@AddProduct')->name('addproduct');
Route::get('editprod/{prodid}', 'ProductsController@EditProduct')->name('editprod');
Route::post('editprodpost', 'ProductsController@EditProductPost')->name('editprodpost');
Route::get('placeorder/{prodid}', 'ProductsController@placeOrder')->name('placeorder');





