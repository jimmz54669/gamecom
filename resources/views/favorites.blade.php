@extends('layouts.app')

@section('content')

<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

 <div class="container" style="margin-top: 90px;">
   <div class="row">
      <div class="col-lg-6 col-md-12">
         <div class="jumborton">
            <div class="card pro-pic-container">
               <div class="row">
                  <div class="col-lg-5 col-md-6">
                     <div class="card img-user">
                        <img src="{{url('/images/logo2.png')}}">
                     </div>
                     <div class="dp-upload-btn">
                        <input type="file" class="btn prof-photo" name="buttonProfPhoto" id="prof_pic_input" hidden/>
                        <label class="btn dp-user-btn" for="prof_pic_input"><i class="bi bi-camera-fill" id="dp_user_btn"></i></label>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="username-users">
                        <h1 class="user-fullname">{{Auth::user()->fname}} {{Auth::user()->lname}}</h1>
                        <h3 class="user-name">@ {{Auth::user()->username}}</h3>
                     </div>
                  </div>
               </div>
               <div class="input-group mt-3 d-flex justify-content-center">
                  <button class="btn text-bold not"><a href="{{ route('profile')}}">Post</a></button>
                  <button class="btn current"><a href="{{ route('favorites')}}">Favorites</a></button>
                  <button class="btn not"><a href="{{ route('cart')}}">Cart -<span class="cart-count"> @if(isset($GetCartCount)) {{$GetCartCount}} @else 0 @endif</span></a></button>
                  <button class="btn not"><a href="{{ route('order')}}">Orders</a></button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-12">
         <div class="jumbotron">
            <div class="favorite-container">
                <div class="game-favorite">
                    <h3 class="favorite-header">Favorites</h3>
                    <div class="row favorite-list">
                       @if(isset($GetFavoriteGames))
                           @foreach($GetFavoriteGames as $GetFavoriteGame)
                           <div class="col-5 game-details me-2 mb-2">
                              <div class="favorite-delete">
                                 <button class="btn btn-favorite-delete" data-gameappid="{{$GetFavoriteGame->id}}"><i class="bi bi-x-octagon"></i></button>
                              </div>
                              <a href="{{ url('gamepage/'.$GetFavoriteGame->gameappid) }}">
                                 <div class="game-pic-favorite">
                                       <img src="{{ url('./images/'.$GetFavoriteGame->gamepic)}}" class="game-thumb-favorite">
                                 </div>
                                 <div class="game-title">
                                       <div class="game-name">{{$GetFavoriteGame->gameappname}}</div>
                                 </div>
                              </a>   
                           </div>
                           @endforeach
                        @endif
                    </div>
                </div>
            </div>
         </div>  
      </div>
      <hr>
      <footer>
         <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <p>Copyright © 2023 <a href="{{ route('about')}}">GameCom</a> Company. All rights reserved. 
                  </div>
               </div>
         </div>
      </footer>  
   </div>
   
 </div>
@endsection