@extends('layouts.app')
   <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.css">
   

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
  <!-- ***** Preloader End ***** -->
   <div class="container" style="margin-top: 90px;">
      <div class="home-content jumbotron glow p-3">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="page-content">

          <!-- ***** Banner Start ***** -->

                     <div class="main-banner carousel slide" id="header" data-bs-ride = "carousel">
                        <div class="row">
                        <div class = "container h-100 d-flex align-items-center carousel-inner">
                           <div class = "carousel-item active">
                              <div class="header-text row d-flex align-items-center">
                                <div class="col home-feed-btn">
                                  <h1 class="second-line">EVOLVE </h1>
                                  <h5>your gaming experience</h5>
                                  <button type="button" class="btn"><a href="{{ route('newsfeed')}}">See Community</a></button>
                                </div>
                                <div class="col">
                                  <img src="{{ url('/images/logo1.png')}}" class="home-carousel-img">
                                </div>
                              </div>
                           </div>
                           <div class = "carousel-item">
                              <div class="header-text row d-flex align-items-center">
                                <div class="col">
                                  <img src="{{ url('/images/homelogin.png')}}" class="home-carousel-img2">
                                </div>
                                <div class="col home-feed-btn">
                                  <h1>Are you ready</h1>
                                  <h5>for a new level of excitement?</h5>
                                  <button type="button" class="btn"><a href="{{ route('login')}}">LOGIN NOW</a></button>
                                </div>
                              </div>
                           </div>
                           <div class = "carousel-item">
                              <div class="header-text">
                                <p>Experience a whole new level of fun with our</p>
                                <h1>MINI-GAMES</h1>
                                <a href="{{ url('games')}}">
                                  <div class="row">
                                        <img class="col game-thumb me-1" src="{{ url('./images/fc.png')}}">
                                        <img class="col game-thumb me-1" src="{{ url('./images/bl.png')}}">
                                        <img class="col game-thumb me-1" src="{{ url('./images/mx3m2.jpeg')}}">
                                      
                                  </div>
                                </a>  
                              </div>
                           </div>
                           
                           
                        </div>
                        <button class = "carousel-control-prev" type = "button" data-bs-target="#header" data-bs-slide = "prev">
                        <span class = "carousel-control-prev-icon"></span>
                     </button>
                     <button class = "carousel-control-next" type = "button" data-bs-target="#header" data-bs-slide = "next">
                        <span class = "carousel-control-next-icon"></span>
                     </button>
                        <!-- <div class="col-lg-7">
                           <div class="header-text">
                              
                              <h6>Welcome To Cyborg</h6>
                              <h4><em>Browse</em> Our Popular Games Here</h4>
                              <div class="main-button">
                              <a href="browse.html">Browse Now</a>
                              </div>
                           </div>
                        </div> -->
                        </div>
                     </div>
          <!-- ***** Banner End ***** -->



          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
            <div class="row" >
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Most Popular</em> Right Now</h4>
                </div>
                <div class="row">
                  <div class="row" id="games-container">

                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <a href="https://www.dota2.com/news" target="_blank" rel="noopener noreferrer"><img src="https://www.freetogame.com/g/229/thumbnail.jpg" class="game-image" alt=""></a>
                      <h6 class="view" onmousedown="return false" onselectstart="return false">View Game</h6>
                      <h4>Dota 2<br><span><i class="fa fa-gamepad"></i> MOBA</span><span class=""> Valve</span></h4>
                      
                      <ul>
                        <li><i class="fa fa-laptop"></i> PC</li>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                     <a href="https://www.fortnite.com/" target="_blank" rel="noopener noreferrer"> <img src="https://www.freetogame.com/g/57/thumbnail.jpg" class="game-image" alt=""></a>
                        <h6 class="view" onmousedown="return false" onselectstart="return false">View Game</h6>
                        <h4>Fortnite<br><span><i class="fa fa-gamepad"></i> Shooting</span><span>Epic Games</span></h4>
                    
                      <ul>
                        <li><i class="fa fa-laptop"></i> PC</li>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                     <a href="https://www.leagueoflegends.com/en-ph/" target="_blank" rel="noopener noreferrer"><img src="https://www.freetogame.com/g/286/thumbnail.jpg" class="game-image" alt=""></a> 
                      <h6 class="view">View Game</h6>
                      <h4>League of Legends<br><span><i class="fa fa-gamepad"></i> MOBA</span><span></span><span>Riot Games</span></h4>
                      <ul>
                        <li><i class="fa fa-laptop"></i> PC</li>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 3.3M</li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <a href="https://m.mobilelegends.com/en" target="_blank" rel="noopener noreferrer"> <img src="https://images.indiafantasy.com/wp-content/uploads/20220617022802/Webp.net-compress-image-26-30.jpg" class="game-image" alt=""></a>
                      <h6 class="view">View Game</h6>
                      <h4>Mobile Legends<br><span><i class="fa fa-gamepad"></i> MOBA</span><span></span><span>Moontoon</span></h4>
                      <ul>
                        <li><i class="fa-solid fa-mobile-screen-button"></i> Mobile</li>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 500M</li>
                      </ul>
                    </div>
                  </div>
                  <!-- <div class="col-lg-6">
                    <div class="item">
                      <div class="row">
                        <div class="col-lg-6 col-sm-6">
                          <div class="item inner-item">
                            <img src="assets/images/popular-05.jpg" alt="">
                            <h4>Mini Craft<br><span>Legendary</span></h4>
                            <ul>
                              <li><i class="fa fa-star"></i> 4.8</li>
                              <li><i class="fa fa-download"></i> 2.3M</li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                          <div class="item">
                            <img src="assets/images/popular-06.jpg" alt="">
                            <h4>Eagles Fly<br><span>Matrix Games</span></h4>
                            <ul>
                              <li><i class="fa fa-star"></i> 4.8</li>
                              <li><i class="fa fa-download"></i> 2.3M</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-07.jpg" alt="">
                      <h4>Warface<br><span>Max 3D</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div> -->
                  <!-- <div class="col-lg-3 col-sm-6">
                    <div class="item">
                      <img src="assets/images/popular-08.jpg" alt="">
                      <h4>Warcraft<br><span>Legend</span></h4>
                      <ul>
                        <li><i class="fa fa-star"></i> 4.8</li>
                        <li><i class="fa fa-download"></i> 2.3M</li>
                      </ul>
                    </div>
                  </div> -->
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="https://www.ign.com/articles/biggest-games-of-2023">Discover Popular</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Most Popular End ***** -->
                <div class="most-popular">
                  <div class="row" >
                    <div class="col-lg-12">
                      <div class="heading-section">
                        <h4><em>Best sellers</em> Right Now</h4>
                      </div>
                      <div class="collection-list row">
                      @if(isset($GetAllProducts))
                        @foreach($GetAllProducts as $GetAllProduct)
                          <div class="home-item-container col-lg-3 col-md-2">
                            <div class="item-img home-item-img">
                              <span class = "position-absolute d-flex align-items-center justify-content-center">SALE!</span>
                              <img src="{{url('/images/'.$GetAllProduct->prodimg)}}">
                            </div>
                            <div class="item-name home-item-name">
                                <h6>{{$GetAllProduct->prodname}}</h6>
                            </div>
                            <div class="item-price home-item-price">
                                <p>₱{{$GetAllProduct->prodprice}}</p>
                            </div>
                            <div class="item-btns input-group">
                                <button type="button" class="btn buy-btn" data-prodid="{{$GetAllProduct->id}}"><a href="#">Buy Now!</a></button>
                                @guest
                                @else
                                <button type="button" class="btn add-to-cart" data-prodcode="{{$GetAllProduct->prodcode}}" data-availability="{{$GetAllProduct->prodqty}}" data-cartqty="1"><i class="bi bi-cart3"></i></button>
                                @endguest
                            </div>
                          </div>
                        @endforeach
                      @endif
                      </div>
                      <div class="col-lg-12 mt-3">
                        <div class="main-button">
                          <a href="{{ route('shop')}}">Shop now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
        </div>
      </div>
    </div>
  </div>
      </div>
   </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2023 <a href="{{ route('about')}}">GameCom</a> Company. All rights reserved. 
          
<!--           <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a></p> -->
        </div>
      </div>
    </div>
  </footer>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>

  <script src="assets/js/custom.js"></script>

@endsection