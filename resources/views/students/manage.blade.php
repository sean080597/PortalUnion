@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">DS Đoàn viên</a></li>
@endsection

@section('link_js')
    <script src="{{ asset('theme/JS/datatable_admin.js') }}" async></script>
    <script src="{{ asset('theme/JS/student.js') }}" async></script>
    {{--  <script>
        $(window).scroll(function() {
            if($('#maxRows').val() == 0){
                if($(window).scrollTop() + $(window).height() >= $(document).height()){
                    var stt_student = $('#stt_student').val();
                    $.get("/students/getMoreStudents", {stt_student: stt_student}, function (data) {
                        if(data != null && data != ''){
                            $('tbody').append(data);
                            stt_student = parseInt(stt_student) + 10;
                            $('#stt_student').val(stt_student);
                        }
                    });
                }
            }
        });
    </script>  --}}
@endsection

@section('content')
<div class="wrap-table">
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white">Lọc</span>
                </div>
                <select name="state" id="maxRows" class="form-control">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="0" selected>Tất cả</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-2">
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
        <div class="col-sm-3 mb-2">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary" id="select-all">Chọn hết</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
        <div class="col-sm-9 mb-2">
            <a href="{{route('students.managecreate')}}" class="btn btn-success mb-2"><i class="fas fa-plus-circle"></i> Thêm đoàn viên</a>
        </div>
    </div>

    <div class="table-responsive" id="load_table_students_manage">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead class="thead-light">
                <tr>
                    <th style="width:10px"></th>
                    <th class="text-center">STT</th>
                    <th class="width-80">MSSV</th>
                    <th class="width-200">Tên</th>
                    <th class="width-80">Chi Đoàn</th>
                    <th class="width-200">Khoa</th>
                    <th class="width-100">Cập nhật</th>
                    <th class="width-80 text-center" colspan="3">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                @endphp
                @foreach ($students as $key => $student)
                <tr>
                    <td class="text-center"><input type="checkbox"></td>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class_room_id }}</td>
                    <td>{{ $student->faculty_name }}</td>
                    <td>{{ $student->updated_at }}</td>
                    <td class="text-center">
                        <a href="{{ action('StudentController@manageshow',
                        [$student['id']]) }}" class="text-secondary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="text-primary">
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="text-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @php
                    $count++;
                @endphp

                @endforeach
                <input type="text" id="stt_student" name="stt_student" style="display: none" value="{{ $count }}">
            </tbody>
        </table>
        <div class="pagination-container">
            {!! $students->links() !!}
        </div>
    </div>
</div>
@endsection