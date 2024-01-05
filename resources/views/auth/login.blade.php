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
            <div class="bg order-1 order-md-2" style="background-image: url('https://images.pexels.com/photos/5025512/pexels-photo-5025512.jpeg?auto=compress&cs=tinysrgb&w=600');">
            </div>
            <div class="contents order-2 order-md-1">

                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7">
                            <h3>Login to <strong>Express colis</strong></h3>
                            <p class="mb-2" style="font-size: 14px; color:black">Veuillez vous connecter à votre compte
                                et commencer l'aventure.</p>
                            <form id="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@gmail.com" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group last mb-3">
                                    <label for="password">Mot de Pass</label>
                                    <input id="password" type="password" name="password" class="form-control @error('email') is-invalid @enderror" placeholder="Your Password" id="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <input type="submit" value="Log In" class="btn btn-block btn-danger">

                            </form>
                            <!-- <div class="foo">
                                <p class="text">Avez vous déjà un compte? <a
                                href="{{ route('register') }}">S'enregistrer
                                Ici</a> </p>
                                <button id="demoButton" class="btn btn-primary">Demo</button>
                            </div> -->
                            <div class="foo">

                                <h2 id="demoButton" class="badge bg-success text-white" style="cursor: pointer;">Demo Application</h2>
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
        <script>
            document.getElementById('demoButton').addEventListener('click', function() {
                // Remplir automatiquement les champs avec des données de connexion de démo
                document.getElementById('email').value = 'test@gmail.com';
                document.getElementById('password').value = 'password';

                // Soumettre automatiquement le formulaire
                document.querySelector('form').submit();
            });
        </script>
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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