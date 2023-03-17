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
                     @if(isset($GetUserInfo))
                        @foreach($GetUserInfo as $userinfo)
                        <div class="card img-user">
                           @if($userinfo->profpic != '')
                           <img src="{{url('/images/'.$userinfo->profpic)}}">
                           @else
                           <img src="{{url('/images/logo2.png')}}">
                           @endif
                        </div>
                        @endforeach
                     @endif
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
                  <button class="btn text-bold current">Post</button>
                  <button class="btn not"><a href="{{ route('favorites')}}">Favorites</a></button>
                  <button class="btn not"><a href="{{ route('cart')}}">Cart -<span class="cart-count"> @if(isset($GetCartCount)) {{$GetCartCount}} @else 0 @endif</span></a></button>
                  <button class="btn not"><a href="{{ route('order')}}">Orders</a></button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-6 col-md-12">
         <div class="jumbotron">
            <div class="create-post card">
               <div class="row">
                  <div class="col-1">
               
                     @if(isset($GetUserInfo))
                        @foreach($GetUserInfo as $userinfo)
                        <div class="user-propic">
                           @if($userinfo->profpic != '')
                           <img src="{{url('/images/'.$userinfo->profpic)}}" class="user-dp">
                           @else
                           <img src="{{url('/images/logo2.png')}}" class="user-dp">
                           @endif
                        </div>
                        @endforeach
                     @endif

                  </div>
                  <div class="col">
                     <div class="user-post-area">
                        <input type="text" class="post-text" name="posttxt" id="post-txt" placeholder="Write Something..." onfocus="this.value=''; this.style.color='violet'" required>
                        <input type="file" class="btn post-photo" name="buttonPostPhoto" id="photo_post" hidden/>
                        <label class="user-mini-pic-label" for="photo_post"><i class="bi bi-image-fill" id="img-post-btn"></i></label>
                        <button type="submit" class="btn post-btn" name="buttonSubmit" id="btn_sub" value="submit">Post</button>
                     </div>
                  </div>
               </div>
            </div>
         </div> 
         <div class="jumbotron">
         @if(isset($GetUserPosts))
            @foreach($GetUserPosts as $GetUserPost)
            <div class="profile-post">
               <div class="user-post">
                        @if($GetUserPost->profpic != '')
                        <img src="{{ url('./images/'.$GetUserPost->profpic)}}" class="user-dp">
                        @else
                        <img src="{{url('/images/logo2.png')}}" class="user-dp">
                        @endif
                     <a href="" class="user-direct-profile">
                        <h5 class="user-post-name">{{$GetUserPost->fname}} {{$GetUserPost->lname}}</h5>
                     </a>
               </div>
               <div class="post-editor">
                  <div class="dropdown">
                     <button class="btn post-edit" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear-wide"></i>
                     </button>
                     <ul class="dropdown-menu">
                        <li class="dropdown-item"><button class="btn delete-post" data-postid="{{$GetUserPost->id}}" data-picname="{{$GetUserPost->imgname}}">Delete</button></li>
                        <li class="dropdown-item"><button class="btn edit-post" data-postid="{{$GetUserPost->id}}" data-picname="{{$GetUserPost->imgname}}">Edit</button></li>
                     </ul>
                  </div>
               </div>
               <div class="post-content">
                  <div class="post-title">
                     <input type="text" class="edit-title-post" id="edit-title-post{{$GetUserPost->id}}" value="{{$GetUserPost->content}}" hidden/>
                     <input type="text" id="old-title-post{{$GetUserPost->id}}" value="{{$GetUserPost->content}}" name="edit_post_content" hidden/>
                     <h3 class="user-post-title" id="user-post-title{{$GetUserPost->id}}">{{$GetUserPost->content}}</h3>
                  </div>
                  <div class="post-body">
                     <input type="file" class="btn img-edit-post-input" name="img-edit-photo" id="img_edit_post{{$GetUserPost->id}}" hidden/>
                     <label class="btn img-edit-post" for="img_edit_post{{$GetUserPost->id}}" id="img-edit-post{{$GetUserPost->id}}" hidden><i class="bi bi-camera-fill"></i></label>
                     @if($GetUserPost->imgname != '')
                     <img src="{{ url('./images/'.$GetUserPost->imgname)}}" class="post-user-pc d-flex justify-content-center">
                     @endif
                  </div>
                  <hr>
                  @guest
                  <p class="guest-notice">Join our community by<a href="{{ route('login') }}"> Log in</a> or <a href="{{ route('register') }}"> Sign-up</a>.</>
                  @else
                  <div class="comment-content">
                     @if(isset($GetUserComments))
                        @foreach($GetUserComments as $GetUserComment)
                        @if($GetUserComment->postid == $GetUserPost->id)
                        <div class="own-comment">
                           <div class="user-comment">
                              @if($GetUserComment->profpic != '')
                              <img src="{{ url('./images/'.$GetUserComment->profpic)}}" class="user-dp">
                              @else
                              <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                              @endif
                              <a href="{{ url('/viewprofile/'.$GetUserComment->userid) }}" class="user-direct-profile">
                                 <h5 class="user-name2">{{$GetUserComment->fname}} {{$GetUserComment->lname}}</h5>
                              </a>
                              <div class="user-comment-content">
                                 <p class="user-comment1">{{$GetUserComment->content}}</p>
                              </div>
                           </div>
                        </div>
                        @endif
                        @endforeach
                     @endif
                  </div>
                  <div class="submit-comment">
                     <input type="text" class="comment-body" id="comment-body{{$GetUserPost->id}}" placeholder="Write comment here..." onfocus="this.value=''; this.style.color='violet'">
                     <button type="submit" class="btn btn-sm comment-btn" data-postid = "{{$GetUserPost->id}}">Submit</button>
                  </div>
                  @endguest
               </div>
            </div>
            @endforeach
         @endif
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
@endsection