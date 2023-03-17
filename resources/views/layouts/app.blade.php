<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GameCom') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
   
    <!-- Fonts -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="icon" href="{{ asset('images/logo2.png')}}" sizes="16x16 32x32" type="image/jpeg">
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}"></script>


    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/newsfeed.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/messages.css') }}" rel="stylesheet">
    <link href="{{ asset('css/game.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gamepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link href="{{ asset('css/favorites.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/placeorder.css') }}" rel="stylesheet">
    <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.css">
    
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                  <img class="img-thumb" src= "{{url('/images/logo2.png')}}"/>   <span class="brand-text1">Game</span><span class="brand-text2">Com</span>
                </a>

                <!-- Search bar -->
                    @guest
                    @else
                    <div class="input-box">
                        <input type="text" class="site-search" onfocus="this.value=''; this.style.color='#302da4'" placeholder="Search for GameCom...">
                        <div id="searchlist"></div>
                        <button type="submit" class="search">
                            <i class="bi bi-search search-icon"></i>
                        </button>
                        <i class="bi bi-x-circle close-icon"></i>
                    </div>
                    @endguest
                <!-- End searchbar -->

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <!-- Right Side Of Navbar -->
                    @guest
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home')}}"><i class="bi bi-house me-1"></i><h6>{{_('Home') }}</h6></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('games')}}"><i class="bi bi-controller me-1"></i><h6>{{ __('Games') }}</h6></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shop')}}"><i class="bi bi-shop me-1"></i><h6>{{ __('Shop') }}</h6></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('newsfeed')}}"><i class="bi bi-newspaper me-1"></i><h6>{{ __('Newsfeed') }}</h6></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about')}}"><span class="material-symbols-outlined">info</span><h6>{{ __('About') }}</h6></a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person me-1"></i><h6>{{ __('Login') }}</h6></a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-r-circle me-1"></i><h6>{{ __('Register') }}</h6></a>
                                </li>
                            @endif
                    </ul>

                    @else
                    
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home')}}"><i class="bi bi-house me-1"></i><h6>{{ __('Home') }}</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}"><i class="bi bi-person me-1"></i><h6>{{ __('Profile') }}</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('games')}}"><i class="bi bi-controller me-1"></i><h6>{{ __('Games') }}</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('getmessages')}}"><i class="bi bi-chat-right-text me-1"></i><h6>{{ __('Messages') }}</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('newsfeed')}}"><i class="bi bi-newspaper me-1"></i><h6>{{ __('Newsfeed') }}</h6></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shop')}}"><i class="bi bi-shop me-1"></i><h6>{{ __('Shop') }}</h6></a>
                            </li>
                    </ul>                
                    @endguest
                    
                </div>
                <!-- user icon -->
                    @guest
                    @else
                    <div class="nav-user-right">
                        <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                            <img width="40px" height="40px" src="{{url('/images/'.Auth::user()->profpic)}}" class="user-dp">
                        </div>
                    </div>

                    <div class="settings-menu">
                        <div class="settings-menu-inner">
                            <div class="user-pro">
                                    <img src="{{url('/images/'.Auth::user()->profpic)}}" class="user-dp">
                                <div class="see-profile">
                                    <p class="user-profile-name fw-bold">{{Auth::user()->fname}} {{Auth::user()->lname}}</p>
                                    <a href="{{ url('profile')}}" class="see_profile mt-0">See your profile</a>
                                </div>
                            </div>
                            <hr>
                            <div class="user-pro-1">
                                <div class="about-link">
                                    <img src="{{ url('/images/about.png')}}" class="info-link1">
                                    <div>
                                        <a class="about-item" href="{{ route('about')}}">About</a>
                                    </div>
                                </div>
                                <div class="settings-link">
                                    <img src="{{ url('/images/settings.png')}}">
                                    <div>
                                        <a class="settings-item" href="{{ route('settings') }}" class="info-link">Settings</a>
                                    </div>
                                </div>
                                <div class="logout-link">
                                    <img src="{{ url('/images/logout.png')}}" class="info-link">
                                    <div>
                                        <a class="logout-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    @endguest
                <!-- end user iv=con -->
                
            </div>    
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    
    <script src="{{ asset('js/nav.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
    <script src="{{ asset('js/gameappcomment.js') }}"></script>
    <script src="{{ asset('js/post-controller.js') }}"></script>
    <script src="{{ asset('js/profile-controller.js') }}"></script>
    <script src="{{ asset('js/message-controller.js') }}"></script>
    <script src="{{ asset('js/products-controller.js') }}"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
    
</html>
