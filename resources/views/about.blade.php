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
    <div class="about-intro">
        <div class="row about-container">
            <div class="col-lg-6">
                <div class="about-header">
                    <h1>We let the world play</h1>
                    <p>Because play is how we learn. That’s why we’re creating the ultimate online playground and community. Free and open to all. Wanna join our community?</p>
                    <button class="btn"><a href="{{ route('login')}}">JOIN NOW</a></button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-header-img mx-5">
                    <img src="{{ url('/images/logo2.png')}}">
                </div>
            </div>
        </div>
        <div class="about-content">
            <div class="about-question">
                <h3>What is <span class="brand-text1">Game</span><span class="brand-text2">Com</span> all about?</h3>
            </div>
            <div class="about-answer">
                <p>We built GameCom to create an ecosystem that brings the Free-to-Play Games into one place. Our vision is to create the most exciting and postive environment.</p>
            </div>
            <div class="about-division">
                <div class="row icon-list">
                    <div class="col-2 icon-desc">
                        <img src="{{ url('/images/controllerlogo.png')}}" class="about-icon">
                        <h4>Easy Discovery</h4>
                        <p>Discover games easily and get introduced to new ones.</p>
                    </div>
                    <div class="col-2 icon-desc">
                        <img src="{{ url('/images/community.png')}}" class="about-icon">
                        <h4>Community-Focused</h4>
                        <p>Voice your opinions, submit post, suggest new features and more!</p>
                    </div>
                    <div class="col-2 icon-desc">
                        <img src="{{ url('/images/folder.png')}}" class="about-icon">
                        <h4>Collect Games</h4>
                        <p>Manage your games library and add games you want to play.</p>
                    </div>
                    <div class="col-2 icon-desc">
                        <img src="{{ url('/images/plus.png')}}" class="about-icon">
                        <h4>Plus More!</h4>
                        <p>We're just getting started! Expect new updates and features.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-we-container mt-5">
            <div class="row about-last">
                <div class="col-lg-6">
                    <!-- Carousel -->
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">

                        <!-- Indicators/dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                        </div>

                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active" id="carousel-item">
                                <img src="{{ url('/images/ag1.jpeg')}}" alt="Los Angeles" class="carousel-img">
                                <div class="carousel-caption">
                                    <h3>Easy access for all</h3>
                                    <p>Together, we’re on a mission to raise the bar for free games on web.</p>
                                </div>
                            </div>
                            <div class="carousel-item" id="carousel-item">
                                <img src="{{ url('/images/ag2.jpeg')}}" alt="Chicago" class="carousel-img">
                                <div class="carousel-caption">
                                    <h3>Play games for Free!</h3>
                                    <p>Our playground offers free online games to millions of people around the world.</p>
                                </div>
                            </div>
                            <div class="carousel-item" id="carousel-item">
                                <img src="{{ url('/images/ag3.jpeg')}}" alt="New York" class="carousel-img">
                                <div class="carousel-caption">
                                    <h3>We connect people!</h3>
                                    <p>Not just game but to connect people by post and messages!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-who-container">
                        <div class="about-who">
                            <div class="about-who">
                                <h2>Who We Are</h2>
                                <p>We pour our hearts and souls into everything we create. We embrace our core values every day so that we can continue creating epic entertainment experiences for all our users. It doesn’t matter who you are or where you’re located—if you’re a member of our evolving and vibrant community, or taking a piece of Gamecom with you into space—you’re welcome here. Gamecom is developed by Aaron, Jimmy and Joseph Eslais where are KodeGo students and web development in this is our project.</p>
                            </div>
                        </div>
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

@endsection