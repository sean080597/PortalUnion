@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('link_js')
{{--  <script src="{{ asset('theme/JS/datatable_admin.js') }}" async></script>  --}}
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">DS Khoa</a></li>
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
                    <option value="0" selected>Tất cả</option>
                </select>
            </div>
        </div>
        <div class="col-md-9 mb-2">
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
        <div class="col-sm-3 mb-2">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary" id="select-all">Chọn hết</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
        <div class="col-sm-9 mb-2">
            <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modal_adjust_faculty" id="open_modal_faculty_to_add_new">
                <i class="fas fa-plus-circle"></i> Thêm khoa
            </a>
        </div>
    </div>

    <div class="table-responsive" id="load_table_faculties_manage">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead class="thead-light">
                <tr>
                    <th style="width:10px"></th>
                    <th class="text-center" style="width:10px">STT</th>
                    <th class="width-100">MÃ Khoa</th>
                    <th class="width-200">Tên Khoa</th>
                    <th>Nhánh</th>
                    <th class="width-100">Cập nhật</th>
                    <th class="text-center" colspan="2">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculties as $key => $faculty)
                <tr>
                    <td class="text-center"><input type="checkbox"></td>
                    <td class="text-center">{{ ++$key }}</td>
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ $faculty->note }}</td>
                    <td>{{ $faculty->updated_at }}</td>
                    <td class="text-center">
                        <a href="#" class="text-primary open_modal_faculty_to_edit" data-toggle="modal"
                        data-target="#modal_adjust_faculty" faculty_id="{{ $faculty->id }}">
                            <i class="fas fa-user-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="text-danger delete_faculty" faculty_id="{{ $faculty->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
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
<!-- Modal --------------------------------->
<div class="modal fade" id="modal_adjust_faculty">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="POST" id="form_adjust_faculty">
                @csrf
                <div class="form-group">
                    <label for="fac-id">Mã Khoa</label>
                    <input type="text" id="fac_id" name="fac_id" class="form-control" maxlength="4">
                    <strong id="error_add_new_faculty" style="color:red; display:none"></strong>
                </div>
                <div class="form-group">
                    <label for="name">Tên Khoa</label>
                    <input type="text" id="fac_name" name="fac_name" class="form-control" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="note">Nhánh</label>
                    <input type="text" id="fac_note" name="fac_note" class="form-control" maxlength="20">
                </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" id="btn_add_new_faculty" class="btn btn-success">Thêm mới</button>
        </div>
      </div>
    </div>
</div>
@endsection