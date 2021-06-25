<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('/frontend-asset/image/icon/delta_favicon.ico')}}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backend | deltaPSU</title>
    <link rel="stylesheet" id="css-main" href="{{asset('backend-asset/css/dashmix.min.css')}}">
</head>
<body>
        <div id="page-container">
                <!-- Main Container -->
                <main id="main-container">
                    <!-- Page Content -->
                    <div class="bg-image" style="background-image: url('{{asset('backend-asset/media/photos/photo19@2x.jpg')}}');">
                        <div class="row no-gutters justify-content-center bg-primary-dark-op">
                            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                                <!-- Sign In Block -->
                                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                                        <!-- Header -->
                                        <div class="mb-2 text-center">
                                            {{-- <img src="{{asset('/assets/icon/Thai-Micro-Logo.svg')}}" style="width: 60%;" alt="logo"> --}}
                                            <p class="text-uppercase font-w700 font-size-sm text-muted">Sign In</p>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-user-circle"></i>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-asterisk"></i>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                                <div class="custom-control custom-checkbox custom-control-primary">
                                                    <input type="checkbox" class="custom-control-input" id="login-remember-me" name="login-remember-me" checked>
                                                    <label class="custom-control-label" for="login-remember-me">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-hero-primary">
                                                    <i class="si si-login mr-1"></i> Sign In
                                                </button>
                                            </div>
                                            {{-- <div class="form-group text-center">
                                                    Copyright © 2019 Thai Micro Digital Solutions Co., Ltd. <br>All rights reserved. <br>
                                                    Design By <a href="https://www.degitobangkok.com/" target="_blank" >DEGITO</a>
                                            </div> --}}
                                        </form>
                                        <!-- END Sign In Form -->
                                    </div>
                                </div>
                                <!-- END Sign In Block -->
                            </div>
                        </div>
                    </div>
                    <!-- END Page Content -->
    
                </main>
                <!-- END Main Container -->
            </div>
    <script src="{{asset('backend-asset/js/dashmix.core.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/dashmix.app.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('backend-asset/js/pages/op_auth_signin.min.js')}}"></script>
</body>
</html>
