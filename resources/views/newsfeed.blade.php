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


    @guest
    <div class="container" style="margin-top: 90px;"> 
        <div class="jumbotron d-flex justify-content-center">
            <div class="create-post col-lg-6 col-md-11 card">
                <div class="row">
                    <p class="guest-notice">Join our community by<a href="{{ route('login') }}"> Log in</a> or <a href="{{ route('register') }}"> Sign-up</a>.</>
                </div>
            </div>
        </div> 
    @else
    <div class="container" style="margin-top: 90px;"> 
        <div class="jumbotron d-flex justify-content-center">
            <div class="create-post col-lg-6 col-md-11 card">
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
                        <div class="user-post-area mt-1">
                            <input type="text" class="post-text" name="post-txt" id="post-txt" placeholder="Write Something..." onfocus="this.value=''; this.style.color='violet'" required>
                            <input type="file" class="btn post-photo" name="buttonPostPhoto" id="photo_post" hidden/>
                            <label class="user-mini-pic-label" for="photo_post"><i class="bi bi-image-fill" id="img-post-btn"></i></label>
                            <button type="submit" class="btn post-btn" name="buttonSubmit" id="btn_sub" value="submit">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endguest
            <div class="jumbotron newsfeed-container">
            @if(isset($GetUserPosts))
                @foreach($GetUserPosts as $GetUserPost)
                <div class="profile-post">
                    <div class="user-post">
                        @if($GetUserPost->profpic != '')
                            <img src="{{ url('./images/'.$GetUserPost->profpic)}}" class="user-dp">
                        @else
                            <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                        @endif
                        <a href="{{ url('/viewprofile/'.$GetUserPost->userid) }}" class="user-direct-profile">
                        <h5 class="user-post-name">{{$GetUserPost->fname}} {{$GetUserPost->lname}}</h5>
                        </a>
                    </div>
                    <div class="post-editor" hidden>
                        <div class="dropdown">
                            <button class="btn post-edit" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear-wide"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><button class="btn">Delete</button></li>
                                <li class="dropdown-item"><button class="btn">Edit</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post-content">
                        <div class="post-title">
                            <input type="text" class="edit-title-post" id="edit-title-post{{$GetUserPost->id}}" value="{{$GetUserPost->content}}" hidden/>
                            <input type="text" id="old-title-post{{$GetUserPost->id}}" value="{{$GetUserPost->content}}" name="edit_post_content" hidden/>
                            <h3 class="user-post-title" id="user-post-title{{$GetUserPost->id}}">{{$GetUserPost->content}}</h3>
                        </div>

                        <div class="post-body d-flex justify-content-center">
                            <input type="file" class="btn img-edit-post-input" name="buttonEditPhoto" id="img_edit_post" hidden/>
                            <label class="btn img-edit-post" for="img_edit_post" id="img-edit-post" hidden><i class="bi bi-camera-fill"></i></label>
                            @if($GetUserPost->imgname != '')
                                <img src="{{ url('./images/'.$GetUserPost->imgname)}}" class="post-user-pc">
                            @endif
                        </div>
                        <hr>
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
                        @guest
                        <p class="guest-notice">Join our community by<a href="{{ route('login') }}"> Log in</a> or <a href="{{ route('register') }}"> Sign-up</a>.</>
                        @else
                        <div class="submit-comment d-flex justify-content-center">
                            <input type="text" class="comment-body" id="comment-body{{$GetUserPost->id}}" placeholder="Write comment here..." onfocus="this.value=''; this.style.color='violet'">
                            <button type="submit" class="btn btn-sm comment-btn" data-postid = "{{$GetUserPost->id}}">Submit</button>
                        </div>
                        @endguest
                    </div>
                </div>    
                @endforeach
            @endif
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