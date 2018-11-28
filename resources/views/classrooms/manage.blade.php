@extends('layouts.app')

@section('show_tab')
<li class="breadcrumb-item"><a href="#">QL Lớp</a></li>
@endsection

@section('content')
<div class="wrap-table">
    <div class="note-info">
        <span>Lưu ý:</span>
        <ul>
            <li>
                <p>Đây là lưu ý</p>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 row pr-0 mr-auto">
            <div class="col-sm-6 mb-2 pr-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white">Khoa / Viện</span>
                    </div>
                    <select class="form-control" name="choose_faculties" id="choose_faculties">
                        <option value="0" disabled selected>=== Chọn Khoa / Viện ===</option>
                        @foreach ($all_faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }} {{ !empty($faculty->note) ? '('.$faculty->note.')' : '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary" id="open_modal_classroom_to_add_new">
                    Tạo mới lớp
                </button>
            </div>
        </div>
        <div class="col-lg-3 mb-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Lọc</span>
                </div>
                <select name="state" id="maxRows" class="form-control">
                    <option value="10">10</option>
                    <option value="0" selected>Tất cả</option>
                </select>
            </div>
        </div>
        <div class="col-lg-9">
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
                    <th class="text-center">STT</th>
                    <th class="text-center">Lớp</th>
                    <th class="text-center">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">15DTH12</td>
                    <td class="text-center">
                        <a href="DGDV.html" class="text-primary"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr> --}}
            </tbody>
        </table>
        <div class="pagination-container">
            <nav>
                <ul class="pagination justify-content-end"></ul>
            </nav>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_classroom">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endsection