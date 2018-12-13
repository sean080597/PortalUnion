@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">TT lớp</a></li>
@endsection

@section('content')
<div class="wrap-table">
    <div class="note-info">
        <div class="row">
            <p class="col-sm-4">
                <span>Bí thư: </span>{{ !empty($cur_classroom->uid_secretary) ? $all_users->where('id', $cur_classroom->uid_secretary)->first()->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($cur_classroom->uid_secretary) ? $all_users->where('id', $cur_classroom->uid_secretary)->first()->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($cur_classroom->uid_secretary) ? $all_users->where('id', $cur_classroom->uid_secretary)->first()->email : '' }}
                </p>
            </div>
        </div>
        <div class="row">
            <p class="col-sm-4">
                <span>Phó bí thư: </span>{{ !empty($cur_classroom->uid_deputysecre1) ? $all_users->where('id', $cur_classroom->uid_deputysecre1)->first()->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($cur_classroom->uid_deputysecre1) ? $all_users->where('id', $cur_classroom->uid_deputysecre1)->first()->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($cur_classroom->uid_deputysecre1) ? $all_users->where('id', $cur_classroom->uid_deputysecre1)->first()->email : '' }}
                </p>
            </div>
        </div>
        <div class="row">
            <p class="col-sm-4">
                <span>Phó bí thư: </span>{{ !empty($cur_classroom->uid_deputysecre2) ? $all_users->where('id', $cur_classroom->uid_deputysecre2)->first()->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($cur_classroom->uid_deputysecre2) ? $all_users->where('id', $cur_classroom->uid_deputysecre2)->first()->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($cur_classroom->uid_deputysecre2) ? $all_users->where('id', $cur_classroom->uid_deputysecre2)->first()->email : '' }}
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white">Lọc</span>
                </div>
                <select name="state" id="maxRows" class="form-control">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="0" selected>Tất cả</option>
                </select>
            </div>
        </div>
        <div class="col-md-9">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-info text-white">Tìm kiếm</span>
                </div>
                <input type="text" class="form-control" id="table-search" />
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th class="width-100">MSSV</th>
                    <th class="width-200">Họ Tên</th>
                    <th class="width-100">Ngày sinh</th>
                    <th class="width-200">Email</th>
                    <th class="width-100">Điện thoại</th>
                    <th class="width-80">Tác vụ</th>
                    <th class="width-100">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key=>$student)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ Carbon\Carbon::parse($student->birthday)->format('d-m-Y') }}</td>
                        <td>{{ $all_users->where('id', $student->user_id)->first()->email }}</td>
                        <td>{{ $all_users->where('id', $student->user_id)->first()->phone }}</td>
                        <td class="text-center text-primary">
                            <a href="{{ action('StudentController@show',
                            $all_students->where('user_id', $student->user_id)->first()->id) }}">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-pill badge-secondary">hello</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            <nav>
                <ul class="pagination justify-content-end"></ul>
            </nav>
        </div>
    </div>
</div>
@endsection