@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('link_js')
{{--  <script src="{{ asset('theme/JS/datatable_admin.js') }}" async></script>  --}}
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">QL Lớp</a></li>
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
                <button type="button" class="btn btn-danger" id="delete-all">Xóa</button>
            </div>
        </div>
        <div class="col-sm-9 mb-2">
            <a href="#" class="btn btn-success mb-2" id="open_modal_classroom_to_add_new">
                <i class="fas fa-plus-circle"></i> Thêm lớp
            </a>
        </div>
    </div>

    <div class="table-responsive" id="load_table_classrooms_manage">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead class="thead-light">
                <tr>
                    <th style="width:10px"></th>
                    <th class="text-center" style="width:10px">STT</th>
                    <th class="width-100">MÃ Lớp</th>
                    <th class="width-100">Khoa</th>
                    <th class="width-80">Cập nhật</th>
                    <th class="text-center" colspan="2">Tác vụ</th>
                </tr>
            </thead>
            <tbody id="tb-body">
                @foreach ($classrooms as $key=>$classroom)
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $classroom->id }}</td>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->updated_at }}</td>
                        <td class="text-center">
                            <a href="#" class="text-primary open_modal_classroom_to_edit"
                            classroom_id="{{ $classroom->id }}" fa_id="{{ $classroom->faculty_id }}"
                            data-toggle="modal" data-target="#modal_adjust_classroom">
                                <i class="fas fa-user-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="#" class="text-danger delete_classroom" classroom_id="{{ $classroom->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {!! $classrooms->links() !!}
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_adjust_classroom">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="POST" id="form_adjust_classroom">
                @csrf
                <div class="form-group">
                    <label for="cla_id">Mã Lớp</label>
                    <input type="text" id="cla_id" name="cla_id" class="form-control" maxlength="10">
                    <strong id="error_add_new_classname" style="color:red; display:none"></strong>
                </div>
                <div class="form-group">
                    <label for="name">Khoa</label>
                    <select name="sel-fac" id="sel-fac" class="form-control">
                        //some options
                    </select>
                </div>
            </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection