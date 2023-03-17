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
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-6 col-sm-12 logo d-flex justify-content-center">
            <img width="400px" height="400px" src="{{url('/images/logo1.png')}}">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card glow" id="login-page">
                <div class="card-header rounded-top-4">
                    <img class="mt-4" width="80px" height="80px" src="{{url('/images/logo2.png')}}">
                    <p class="display-6 mb-0 fw-bold">Log<span style="color: violet;">in</span></p>
                </div>
                <div class="card-body rounded-bottom-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mt-2">
                            <input type="textbox" class="form-control @error('email') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email/Username">
                            <label for="email" class="form-label"><i class="bi bi-person-fill"></i><span>Email/Username</span></label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mt-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="password" id="password" required autocomplete="current-password" autofocus placeholder="Password">
                            <label for="password" class="form-label"><i class="bi bi-lock-fill"></i><span>Password</span></label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4 mb-3 row">
                            <div class="offset">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label remember" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="offset">
                                <button type="submit" class="btn log-in-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                        <div class="form-group row mb-4">
                            <div class="offset">
                                <button class="btn log-in-btn">
                                    <a href="{{ route('register')}}" class="registration">{{ __('Creat Account') }}</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
