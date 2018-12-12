@extends('layouts.appAdmin')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="{{url('admin/student')}}">Index</a></li>
@endsection

@section('content')
    <div class="wrap-table">
        <div class="row">
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white">Lọc</span>
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
            <div class="col-md-9 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-info text-white">Tìm kiếm</span>
                    </div>
                    <input type="text" class="form-control" id="table-search" />
                </div>
            </div>
            <div class="col-sm-3 mb-2">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary" id="select-all">Chọn hết</button>
                    <button type="button" class="btn btn-danger">Xóa</button>
                </div>
            </div>
            <div class="col-sm-9 mb-2">
                <a href="{{url('admin/student/create')}}" class="btn btn-success mb-2"><i class="fas fa-plus-circle"></i> Thêm đoàn viên</a>
            </div>
        </div>

        <div class="table-responsive">
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
                <tbody id="tb-body">
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
@section('link_js')
    <script>
        function show(){
            $.ajax({
                type:'GET',
                url:'/admin/showAll',
                success:function(dt){
                    $.each(dt.data,function(key,value){
                        $('#tb-body').append(
                            '<tr>'+
                                '<td class="text-center"><input type="checkbox" name="item[]" pid="'+value.id+'"></td>'+
                                '<td class="text-center">'+(key+1)+'</td>'+
                                '<td>'+value.id+'</td>'+
                                '<td>'+value.name+'</td>'+
                                '<td>'+value.class_room_id+'</td>'+
                                '<td>'+value.fac+'</td>'+
                                '<td>'+value.updated_at+'</td>'+
                                '<td class="text-center"><a href="{{url('admin/student/')}}/'+value.id+'" class="text-primary edit" pid="'+value.id+'"><i class="fas fa-user-edit"></i></a></td>'+
                                '<td class="text-center"><a href="#" class="text-danger delete" pid="'+value.id+'"><i class="fas fa-trash-alt"></i></a></td>'+
                            '</tr>'
                        );
                    });
                    $('.delete').on('click',function(){
                        var id = $(this).attr('pid');
                        deleteStudent(id);
                    });
                }
            });
        }
        function deleteStudent(id){
            $.ajax({
                type:'DELETE',
                url:'student/'+id,
                success:function(data){
                    alert(data);
                    location.reload();
                }
            });
        }
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ajaxComplete(function(){
                call_tracking_input_search();
                call_tracking_select_all();
            });
            show();
        });
    </script>
@endsection