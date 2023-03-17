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
        <div class="user-setting-profile">
            <div class="first-name-setting">
                <h4>First name:</h4>
                <h5>asdasdas</h5>
                <input type="text" id="new-first-name-edit" hidden/>
                <input type="text" id="old-first-name" hidden/>
                <button class="btn edit-firstname" ><i class="bi bi-pencil"></i></button>
            </div>
            <hr>
            <div class="last-name-setting">
                <h4>Last name:</h4>
                <h5>sadasdasdad</h5>
                <input type="text" id="new-last-name-edit" hidden/>
                <input type="text" id="old-last-name" hidden/>
                <button class="btn edit-lastname"><i class="bi bi-pencil"></i></button>
            </div>
            <hr>
            <div class="uname-setting">
                <h4>Username:</h4>
                <h5>sdasda213</h5>
                <input type="text" id="new-username-edit" hidden/>
                <input type="text" id="old-username" hidden/>
                <button class="btn edit-username"><i class="bi bi-pencil"></i></button>
            </div>
        </div>
    </div>
    <hr>
   <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 <a href="#">GameCom</a> Company. All rights reserved. 
                </div>
            </div>
        </div>
    </footer>  
</div>

@endsection