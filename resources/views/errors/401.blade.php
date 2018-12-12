@extends('layouts.app')
@section('style_css')
    <style>
        .wrap-img{
            width: 100%;
            margin: 0 auto;
        }
        #current-page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
        }
    </style>
@endsection
@section('content')
    <div class="row" id="current-page">
        <div class="col-lg-6 mt-3">
            <div class="wrap-img">
                <img src="{{asset('theme/images/page401.jpg')}}" alt="img" width="100%">
            </div>
        </div>
        <div class="col-lg-6 d-flex justify-content-center align-items-center text-center text-danger">
            <h1>Tài khoản của bạn không có quyền truy cập vào trang này</h1>
        </div>
        <div class="col-lg-12 mt-2">
            <h3 class="text-center">Quay trở lại <a href="{{url('/')}}" class="text-primary">Trang Chủ</a></h3>
        </div>
    </div>
@endsection