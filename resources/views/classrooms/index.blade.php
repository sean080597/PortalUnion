@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('link_js')
<script src="{{ asset('theme/JS/datatable_client.js') }}" async></script>
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">TT Khoa</a></li>
@endsection

@section('content')
<div class="wrap-table">
    <div class="note-info">
        <div class="row">
            <p class="col-sm-4">
                <span>Bí thư: </span>{{ !empty($user_sec) ? $user_sec->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($user_sec) ? $user_sec->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($user_sec) ? $user_sec->email : '' }}
                </p>
            </div>
        </div>
        <div class="row">
            <p class="col-sm-4">
                <span>Phó bí thư: </span>{{ !empty($user_de1) ? $user_de1->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($user_de1) ? $user_de1->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($user_de1) ? $user_de1->email : '' }}
                </p>
            </div>
        </div>
        <div class="row">
            <p class="col-sm-4">
                <span>Phó bí thư: </span>{{ !empty($user_de2) ? $user_de2->name : '' }}
            </p>
            <div class="col-sm-8 row">
                <p class="col-5">
                    <span>ĐT: </span>{{ !empty($user_de2) ? $user_de2->phone : '' }}
                </p>
                <p class="col-7 px-0">
                    <span>Email: </span>{{ !empty($user_de2) ? $user_de2->email : '' }}
                </p>
            </div>
    </div>
    </div>

    <div class="row">
        {{-- <div class="col-md-3 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white">Lọc</span>
                </div>
                <select name="state" id="maxRows" class="form-control">
                    <option value="10">10</option>
                    <option value="0" selected>Tất cả</option>
                </select>
            </div>
        </div> --}}
        <div class="col-md-9">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white">Tìm kiếm</span>
                </div>
                <input type="text" class="form-control" id="table-search" />
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary cus-btn-search" type="button">Tìm</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white">Tìm thấy</span>
                </div>
                <input type="text" class="form-control" id="total_found_result" disabled>
            </div>
        </div>
    </div>
    <p></p>
    <div class="table-responsive" id="load_table_classrooms">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th class="width-100">Chi đoàn</th>
                    <th class="width-200">Bí thư</th>
                    <th class="width-200">Email</th>
                    <th class="width-100">Điện thoại</th>
                    <th class="width-80">Tác vụ</th>
                    <th class="width-100">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $key=>$classroom)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $classroom->id }}</td>
                        <td>{{ !empty($lsToShow_secs[$key]) ? $lsToShow_secs[$key]->name : ''  }}</td>
                        <td>{{ !empty($lsToShow_secs[$key]) ? $lsToShow_secs[$key]->email : '' }}</td>
                        <td>{{ !empty($lsToShow_secs[$key]) ? $lsToShow_secs[$key]->phone : '' }}</td>
                        <td class="text-center text-primary">
                            <a href="{{ action('StudentController@index', [$cur_faculty->id, $classroom->id]) }}">
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
            {!! $classrooms->links() !!}
        </div>
    </div>
    {{-- input to store faculty_id --}}
    <input type="hidden" id="faculty_id" name="faculty_id" value="{{ $cur_faculty->id }}">
</div>
@endsection