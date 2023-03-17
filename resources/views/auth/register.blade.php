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
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6 col-md-6 col-sm-12 mt-5 logo d-flex justify-content-center">
            <img width="400px" height="400px" src="{{url('/images/logo1.png')}}">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card glow" id="login-page">
                <div class="card-header rounded-top-4">
                    <img class="mt-4" width="80px" height="80px" src="{{url('/images/logo2.png')}}">
                    <p class="display-6 mb-0 fw-bold">Regis<span style="color: violet;">ter</span><p>
                </div>
                
                <div class="card-body rounded-bottom-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- First Name -->
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="textbox" class="form-control @error('fname') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="fname" id="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder="First name">
                                    <label for="fname" class="form-label"><span>First name</span></label>
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Last name -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="textbox" class="form-control @error('lname') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="lname" id="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus placeholder="Last name">
                                    <label for="lname" class="form-label"><span>Last name</span></label>
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
        
                        <!-- Username -->
                        <div class="row mt-4">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="textbox" class="form-control @error('username') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="username" id="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                                    <label for="username" class="form-label"><span>Username</span></label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Birthday -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="birthday" id="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus placeholder="Birthday">
                                    <label for="birthday" class="form-label"><span>Birthday</span></label>
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="row mt-4">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="textbox" class="form-control @error('email') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                    <label for="email" class="form-label"><span>Email</span></label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" onfocus="this.value=''; this.style.color='aqua'" name="password" id="password" required autocomplete="new-passwrod" placeholder="Password">
                                    <label for="password" class="form-label"><span>Password</span></label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- confirm password -->
                        <div class="confirm-pass mt-4">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password_confirmation" onfocus="this.value=''; this.style.color='aqua'" id="password-confirm" required autocomplete="new-passwrod" placeholder="Confirm password">
                                <label for="password-confirm" class="form-label"><span>Confirm password</span></label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy"> Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
                        </div>
                        <div class="form-group row mt-4 mb-1">
                            <div class="offset">
                                <button type="submit" class="btn log-in-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <div class="procced-login">
                            <p class="text-login">Already a member?<a href="{{ route('login') }}"> Log In</a> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
