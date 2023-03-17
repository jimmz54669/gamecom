@extends('layouts.app')

@section('content')

 <div class="container" style="margin-top: 90px;">
   <div class="row">
      <div class="col-lg-6 col-md-12">
      @foreach($GetUserInfo as $uinfo)
         <div class="jumborton">
            <div class="card pro-pic-container">
            
               <div class="row">
                  <div class="col-lg-5 col-md-6">
                     <div class="card img-user">
                        @if($uinfo->profpic != '')
                           <img src="{{url('/images/'.$uinfo->profpic)}}">
                        @else
                           <img src="{{url('/images/logo2.png')}}">
                        @endif
                        
                     </div>
                  </div>
                  
                  <div class="col-lg-6 col-md-6">
                     <div class="username-users">
                        <h1 class="user-fullname">{{$uinfo->fname}} {{$uinfo->lname}}</h1>
                        <h3 class="user-name">@ {{$uinfo->username}}</h3>
                     </div>
                  </div>
                  
               </div>
               <div class="input-group mt-3 d-flex justify-content-center">
                  <button class="btn text-bold current">Post</button>
                  <button class="btn not"><a href="{{ url('/directmessage/'.$uinfo->id)}}">Message</a></button>
               </div>
            </div>
         </div>
      @endforeach
      </div>
      <div class="col-lg-6 col-md-12">
         @foreach($GetUserPosts as $GetUserPost) 
         <div class="jumbotron">
            <div class="profile-post">
               <div class="user-post">
                        @if($GetUserPost->profpic != '')
                           <img src="{{ url('./images/'.$GetUserPost->profpic)}}" class="user-dp">
                        @else
                           <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                        @endif
                        <a href="" class="user-direct-profile">
                        <h5 class="user-post-name">{{$GetUserPost->fname}} {{$GetUserPost->lname}}</h5>
                     </a>
               </div>
               <div class="post-content">
                  <div class="post-title">
                     <h3 class="user-post-title" id="user-post-title">{{$GetUserPost->content}}</h3>
                  </div>
                  @if($GetUserPost->imgname != '')
                  <div class="post-body">
                     <img src="{{ url('./images/'.$GetUserPost->imgname)}}" class="post-user-pc d-flex justify-content-center">
                  </div>
                  @endif
                  <hr>
                  <div class="comment-content">
                     @foreach($GetUserComments as $GetUserComment)
                     @if($GetUserComment->postid == $GetUserPost->id)
                     <div class="own-comment">
                        <div class="user-comment">
                           @if($GetUserComment->profpic != '')
                              <img src="{{ url('./images/'.$GetUserComment->profpic)}}" class="user-dp">
                           @else
                              <img src="{{ url('./images/logo2.png')}}" class="user-dp">
                           @endif
                           <a href="" class="user-direct-profile">
                              <h5 class="user-name2">{{$GetUserComment->fname}} {{$GetUserComment->lname}}</h5>
                           </a>
                           <div class="user-comment-content">
                              <p class="user-comment1">{{$GetUserComment->content}}</p>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endforeach
                     
                  </div>
                  <div class="submit-comment">
                     <input type="text" class="comment-body" id="comment-body{{$GetUserPost->id}}" placeholder="Write comment here..." onfocus="this.value=''; this.style.color='violet'">
                     <button type="submit" class="btn btn-sm comment-btn" data-postid = "{{$GetUserPost->id}}">Submit</button>
                  </div>
               </div>
            </div>
         </div> 
         @endforeach 
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