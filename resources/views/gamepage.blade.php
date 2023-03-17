@extends('layouts.app')

@section('content')



<div class="container" style="margin-top: 90px;">
    <div class="jumbotron">
        @if(isset($GetGameApp))
        @foreach($GetGameApp as $row)
        <div class="game-container">
            <div class="game-title">
                <h3>{{$row->gameappname}}</h3>
            </div>
            <div class="game-body">
                <div class="the-game">
                    @if($row->gamebehavior == 'script')
                        <script src="{{$row->gameapplink}}"></script>
                    @else
                        <iframe src="{{$row->gameapplink}}" id="item-direct-container" class="item-direct-container resizable" width="960" height="600" allow="autoplay" allowfullscreen="" frameborder="0" scrolling="no" data-src="{{$row->gameapplink}}" style="display: block;"></iframe>
                    @endif
                </div>
            </div>
        </div>
        <div class="add-favorite-gamepage">
            <button class="btn btn-favorite-gamepage" data-gameappid="{{$row->id}}"><i class="bi bi-heart-fill"></i><p>Add to Favorites</p></button>
        </div>
        @endforeach
        @endif
    </div>
    @guest
    <p class="guest-notice">Join our community by<a href="{{ route('login') }}"> Log in</a> or <a href="{{ route('register') }}"> Sign-up</a>.</>
    @else
    <div class="comment-con">
    @if(isset($GetGameAppComment))
        @foreach($GetGameAppComment as $rw)
        <div class="game-comment-box mt-2"> 
            <div class="comment-container">
                <div class="comments">
                    <img src="{{ url('./images/logo1.png')}}" class="user-dp">
                    <a href="#">
                        <h5>{{$rw->fname}} {{$rw->lname}}</h5>
                    </a>
                    <p>{{$rw->content}}</p>
                </div>
            </div> 
        </div>
        @endforeach
    @endif
    </div>
    <div class="game-user-comment">
        <input type="textarea" class="gameappcomment" name="comment" placeholder="Write comment...">
        <button type="submit" class="btn addgameappcommentbtn" data-userid="{{Auth::user()->id}}" data-gameappid="{{$row->id}}" >Submit</button>
    </div>
    @endguest
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



@endsection