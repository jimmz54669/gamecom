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
    <div class="jumbotron">
        <div class="row">
        @if(isset($GameApps))
            @foreach($GameApps as $row)
                <div class="col game-details me-2 mb-2">
                
                <a href="{{ url('/gamepage/'.$row->id) }}">
                    <div class="game-pic">
                        <img src="{{ url('./images/'.$row->gamepic)}}" class="game-thumb">
                    </div>
                   
                    <div class="game-title">
                        <div class="game-name">{{$row->gameappname}}</div>
                    </div>
                </a>
                @guest
                @else 
                <div class="add-favorite">
                    <button class="btn btn-favorite" data-gameappid="{{$row->id}}"><i class="bi bi-heart-fill"></i></button>
                </div>
                @endguest  
        </div>
            @endforeach
        @endif
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