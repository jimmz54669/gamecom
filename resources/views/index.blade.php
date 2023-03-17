<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
        

        <!-- Styles -->
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900");

            * {
                font-family:'Poppins', sans-serif;
            }

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Poppins', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: rgb(48, 47, 47);
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .title img{
                width: 100%;
                max-width: 480px;
            }

            .link h2{
                color: aqua;
                text-transform: uppercase;
                text-shadow: 5px 5px #3a2da4;
                font-weight: 700;
            }

            .link p{
                color: violet;
                font-size: 20px;
                font-weight: bold;
                text-shadow: 5px 5px #3a2da4;
            }

            .links > a {
                color: aqua;
                padding: 0 25px;
                font-size: 20px;
                text-shadow: 5px 5px #3a2da4;
                font-weight: 700;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover{
                color: violet;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/home') }}">Home</a>

                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" style="margin-top: 90px;">
                    <img src="{{url('/images/logo2.png')}}">
                </div>

                <div class="link">
                    <h2>Welcome to the world of gamers</h2>
                    <p>It’s for everyone, not just gamers</p>
                </div>
            </div>
        </div>
    </body>
</html>
