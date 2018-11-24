<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('link_css')
</head>
<body>
    <section class="container-fluid">
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
            <a href="/" class="navbar-brand mr-auto" style="width:130px">
                <img src="{{ asset('theme/images/logo1.png') }}" alt="Logo" style="width:100%">
            </a>
            <div class="student-info">
                <div class="dropdown">
                    <span>Hi! </span>
                    <button type="button" class="btn dropdown-toggle pr-4" data-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="fas fa-user mr-1"></i>Thông Tin</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-key mr-1"></i>Đổi mật khẩu</a>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        >
                            <i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </nav><!-- End navbar -->

        <section class="wrapper">
            <nav id="sidebar">
                <section class="sidebar-header d-flex flex-column align-items-center">
                    <div class="wrap-avatar">
                        <img id="layout-profile-img" src="{{ !empty(auth()->user()->image) ? asset('images/'.auth()->user()->image) : asset('theme/images/img_avatar1.png') }}" alt="avatar">
                    </div>
                    <h4>{{ auth()->user()->name }}</h4>
                </section>
                <ul class="list-unstyled components" id="test"><!--list unstyled = list style type: none | components: -->
                    <li class="active">
                        <a href="/">Trang Chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('faculties.manage') }}">QL Khoa Viện</a>
                    </li>
                    <li>
                        <a href="{{ route('classrooms.manage') }}">QL Lớp</a>
                    </li>
                    <li>
                        <a href="#thong-tin-dv" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">Thông tin đoàn viên</a>
                        <ul class="collapse list-unstyled" id="thong-tin-dv">
                            @if (auth()->user()->role_id == 'fac'
                            || auth()->user()->role_id == 'cla'
                            || auth()->user()->role_id == 'stu')
                            <li>
                                <a href="{{ action('StudentController@show',
                                $all_students->where('user_id', Auth::user()->id)->first()->id) }}">
                                    Thông tin cá nhân
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->role_id == 'fac'
                            || auth()->user()->role_id == 'cla')
                            <li>
                                <a href="{{ action('StudentController@index',
                                [$all_classrooms->where('id', $all_students->where('user_id', Auth::user()->id)->first()->class_room_id)->first()->faculty_id,
                                $all_students->where('user_id', Auth::user()->id)->first()->class_room_id]) }}">
                                    DS Đoàn Viên
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->role_id == 'fac')
                            <li>
                                <a href="{{ action('ClassRoomController@index',
                                [$all_classrooms->where('id', $all_students->where('user_id', Auth::user()->id)->first()->class_room_id)->first()->faculty_id]) }}">
                                    DS Lớp
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->role_id == 'sch')
                            <li><a href="{{ route('faculties.index') }}">DS khoa viện</a></li>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="#ql-dv" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false">
                            ĐG đoàn viên
                        </a>
                        <ul class="collapse list-unstyled" id="ql-dv">
                            <li><a href="#">ĐG cá nhân</a></li>
                            <li><a href="#">Lớp quản lý</a></li>
                            <li><a href="#">Khoa quản lý</a></li>
                            <li><a href="#">Trường quản lý</a></li>
                        </ul>
                    </li>
                    <li><a href="layout.html">Hỗ trợ</a></li>
                </ul>
            </nav><!-- End nav sidebar -->
            <div id="content" class="container-fluid">
               <!-- Setting -------------------------------------------------->
               <section class="d-flex" id="nav-setting">
                    <!-- Btn Collapse for sidebar -->
                    <button class="btn btn-primary" type="button" id="sidebarCollapse">
                        <i class="fas fa-align-left"></i>
                        <span id="btn-sidebar">Sidebar</span>
                    </button>
                    <!-- End Collapse Sidebar -->
                    <!-- Breadcrum ------------->
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        @yield('show_tab')
                    </ul>
                    <!-- End Breadcrum --------->
                </section>
                <!-- End Setting ---------------------------------------------->
                <section class="main-content"><!-- Main content -->

<!---------------------------------------------------------------------------------------------------------->
                    @include ('partials.message')
                    @yield('content')

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                </section><!-- End main content -->
                <section class="footer">
                    <small>Bản quyền của <a href="#">HUTECH</a> - Được phát triển bởi <a href="#">Author</a> &copy; 2018-2019</small>
                </section>
            </div><!-- End content -->
        </section>
    </section>
    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Core plugin JavaScript-->
    {{-- <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script> --}}

    <script src="{{ asset('theme/JS/datatable.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/JS/javascript.js') }}"></script>
    @yield('link_js')
</body>
</html>