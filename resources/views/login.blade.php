

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login.</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="{{ asset('css/custom-cs.css') }}">
        
    </head>
    
    <body>
        <div class="container-fluid px-5 px-md-3 px-lg-1 px-xl-5 py-5 mx-auto w-75">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6 overlapper">
                        <img class="my-logo" src="{{ asset('materials/e-ADAPP logo 23.png') }}" alt=""/>
                        <form class="card2 card border-0 px-4 py-5 the-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            @if ($errors->has('email'))
                                <style>
                                    .show-password {
                                        top: 33%;
                                    }
                                </style>
                            @endif

                            @error('email')
                                    <span class="text-danger mb-2 text-center" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                            @enderror

                            <div class="row px-3">
                                <label class="mb-1 font-weight-bolder"><h6 class="mb-0 text-sm">{{ __('Email') }}</h6></label>
                                <input class="mb-2 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email or Username" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                            </div>
                            <div class="row px-3">
                                <label class="mb-1 font-weight-bolder"><h6 class="mb-0 text-sm">{{ __('Password') }}</h6></label>
                                <input id="passworD" type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                                <img src="{{ asset('materials/hide.png') }}" alt="" class="show-password" onclick="togglePassword()"/>
                            </div>
                            <div class="row px-3 mb-2 mt-2 px-5 pl-5">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chk1" type="checkbox" name="chk" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}> 
                                    <label for="chk1" class="custom-control-label text-sm">{{ __('Remember Me') }}</label>
                                </div>
                                <a href="#" class="ml-auto mb-0 text-sm text-black-50">Forgot Password</a>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-success text-center p-2 login-btn">{{ __('Login') }}</button>
                            </div>
                            <div class="row mb-3 px-3">
                                <small class="register-link">{{ __('Dont have an account?') }} <a class="text-success pl-2">{{ __('Sign up') }}</a></small>
                            </div>

                            <div class="row px-3 mb-3">
                                <div class="line"></div>
                                <small class="or text-center">{{ __('Or continue with:') }}</small>
                                <div class="line"></div>
                            </div>

                            <div class="row mb-4 px-4 pl-4 justify-content-between">
                                <a href="{{ url('login/google') }}" class="icon-group text-center p-1"><img class="social-icon" src="{{ asset('materials/search.png') }}" alt="google logo"></a>
                                <a href="{{ url('login/facebook') }}" class="icon-group text-center p-1"><img class="social-icon" src="{{ asset('materials/facebook.png') }}" alt="facebook logo"></a>
                                <a href="{{ url('login/twitter') }}" class="icon-group text-center p-1"><img class="social-icon" src="{{ asset('materials/twitter.png') }}" alt="twitter logo"></a>
                            </div>
                            
                            <div class="row mb-4 px-3">
                                <p class="lil-note">{{ __('By clicking the button above you agree to out') }} <a href="#" class="text-success">{{ __('terms of use') }}</a> {{ __('and') }} <a href="#" class="text-success">{{ __('privacy policy') }}</a>.</p>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-lg-6 bg-backg223 px-4"></div>
                </div>
            </div>
        </div>
      
        <script src="{{ asset('js/custom-js.js') }}"></script>
    </body>
</html>