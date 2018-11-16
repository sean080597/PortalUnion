<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- base url -->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom fonts for this template-->
   <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->

    <!-- Font google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700 " rel="stylesheet">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('theme/CSS/login.css') }}">
</head>
<body>
    <section class="container-fluid">
        <div id="loader-wrapper">
                <div id="loader"></div>
                <div class="loader-section section-left"></div>
                <div class="loader-section section-right"></div>
        </div>
        <div id="wrapper-header">
            <header>
                <div class="wrapper-img-logo">
                    <a href="#"><img src="{{ asset('theme/images/logo1.png') }}" alt="logo"></a>
                </div>
            </header>
        </div>
        <section class="container">
            <div class="row">
                <section class="col-lg-7 hidden">
                    <div class="d-flex flex-column align-items-center">
                        <section class="container-fluid congtt">
                            <div class="d-flex flex-column align-items-start">
                                <h4 class="text-danger mt-4">Cổng thông tin đoàn khoa</h4>
                                <p class="mt-4">Kênh thông tin dành cho tất cả đoàn viên</p>
                                <div class="d-inline mt-custom">
                                    <a href="https://www.hutech.edu.vn/" class="btn btn-customize btn-sm" target="_blank">Trang chủ HUTECH</a>
                                    <a href="/login.html" class="btn btn-customize btn-sm" target="_blank">Author</a>
                                </div>
                            </div>
                            <div class="wrapper-img-app">
                                <img src="{{ asset('theme/images/iphoneview.png') }}" alt="iphoneview">
                            </div>
                        </section>
                        <section class="d-flex justify-content-center">
                            <div class="wrapper-img-ios">
                                <a href="https://itunes.apple.com/us/app/e-hutech/id1237567424?ls=1&mt=8" target="_blank">
                                    <img src="{{ asset('theme/images/ios.png') }}" alt="ios">
                                </a>
                            </div>
                            <div class="wrapper-img-android">
                                <a href="https://play.google.com/store/apps/details?id=hutech.edu.vn714799&hl=vi" target="_blank">
                                    <img src="{{ asset('theme/images/android.png') }}" alt="android">
                                </a>
                            </div>
                        </section>
                    </div>
                </section>
                <section class="col-lg-5 d-flex flex-column align-items-center loginform">
                    <div class="wrapper-form">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <header>
                                <br>
                                <div class="bg-layout-1">Đăng nhập</div>
                                <div class="bg-layout-2"></div>
                                <div class="bg-layout-3"></div>
                            </header>
                            <fieldset>
                                <div class="form-group">
                                    <label for="taikhoan">Tài khoản:</label>
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                            <footer class="clearfix">
                                <button type="submit" class="btn btn-primary btn-sm float-right">Đăng nhập</button>
                            </footer>
                        </form>
                    </div>
                    <p class="mt-4">Version 1.0.0</p>
                    <p>Bản quyền của HUTECH</p>
                    <p>Phát triển bởi Author &copy; 2018-2019</p>
                    <ul class="d-flex flex-row text-center list-unstyled">
                        <li class="mr-2">
                            <a href="https://www.facebook.com/hutech.itcenter/" class="btn btn-primary btn-circle" target="_blank"><i class="fab fa-facebook-square"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCICDAfLAzWgTrMJrDLcMZWw" class="btn btn-danger btn-circle" target="_blank"><i class="fab fa-youtube-square"></i></a>
                        </li>
                    </ul>
                </section>
            </div>
        </section>
    </section>
    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    {{-- <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/JS/javascript.js') }}"></script>
</body>
</html>