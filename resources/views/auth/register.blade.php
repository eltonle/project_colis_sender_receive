<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('css/css/owl.carousel.min.css') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/css/bootstrap.min.css') }}">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/css/style.css') }}">
        <style>
            .foo {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 5px;
            }

            .text {
                font-size: 15px;
                font-weight: 700;
            }
        </style>
        <title>Login #2</title>
    </head>

    <body>


        <div class="d-lg-flex half">
            <div class="bg order-1 order-md-2"
                style="background-image: url('https://images.pexels.com/photos/6169170/pexels-photo-6169170.jpeg?auto=compress&cs=tinysrgb&w=600');">
            </div>
            <div class="contents order-2 order-md-1">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-12">
                            <h3>Register to <strong>Express colis</strong></h3>
                            <p class="mb-2" style="font-size: 14px; color:black">Please create an account and
                                start the
                                adventure.</p>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group first col-md-6">
                                        <label for="lastname" style="font-style: italic">Last name <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="lastname"
                                            class="form-control @error('lastname') is-invalid @enderror" placeholder=""
                                            id="lastname" value="{{ old('lastname') }}">
                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group first col-md-6">
                                        <label for="firstname" style="font-style: italic">First name <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="firstname"
                                            class="form-control @error('firstname') is-invalid @enderror" placeholder=""
                                            id="firstname" value="{{ old('firstname') }}">
                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group first col-md-6">
                                        <label for="email" style="font-style: italic">Email <span
                                                style="color:red;">*</span></label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder=""
                                            id="email" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group first col-md-6">
                                        <label for="phone" style="font-style: italic">Phone number <span
                                                style="color:red;">*</span> </label>
                                        <input type="tel" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" placeholder=""
                                            id="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group first col-md-6">
                                        <label for="password" style="font-style: italic">Password<span
                                                style="color:red;">*</span></label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror " placeholder=""
                                            id="password" value="{{ old('password') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group first col-md-6">
                                        <label for="password-confirm" style="font-style: italic">password comfirmation
                                            <span style="color:red;">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="" id="password-confirm" value="{{ old('email') }}">

                                    </div>
                                </div>
                                {{-- <div class="form-group first col-md-5">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="email@gmail.com" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group first col-md-5">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="email@gmail.com" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group last mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Your Password" id="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-flex mb-4 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" name="remenber" {{ old('remember') ? 'checked' : '' }} />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div> --}}

                                <input type="submit" value="registration" class="btn btn-block btn-danger">

                            </form>
                            <div class="foo">
                                <p class="text">You already have an account? <a href="{{ route('login') }}">Login
                                        here</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <script src="{{ asset('css/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('css/js/popper.min.js') }}"></script>
        <script src="{{ asset('css/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('css/js/main.js') }}"></script>
    </body>

    </html>
</body>

</html>















{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}










{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}