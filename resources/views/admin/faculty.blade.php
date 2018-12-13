@extends('layouts.appAdmin')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href={{url('/admin/faculty')}}>DS Lớp</a></li>
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
                <button type="button" class="btn btn-danger" id="delete-all">Xóa</button>
            </div>
        </div>
        <div class="col-sm-9 mb-2">
            <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#myModal" id="create"><i class="fas fa-plus-circle"></i> Thêm khoa</a>
        </div>
    </div>

    <div class="table-responsive">
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
                @foreach ($faculties as $item => $faculty)
                    <tr>
                        <td class="text-center"><input type="checkbox" name="item[]" pid="{{$faculty->id}}"></td>
                        <td class="text-center">{{++$item}}</td>
                        <td>{{$faculty->id}}</td>
                        <td>{{$faculty->name}}</td>
                        <td>{{$faculty->note}}</td>
                        <td>{{$faculty->updated_at}}</td>
                        <td class="text-center"><a href="#" class="text-primary edit" data-toggle="modal" data-target="#myModal" pid="{{$faculty->id}}"><i class="fas fa-user-edit"></i></a></td>
                        <td class="text-center"><a href="#" class="text-danger delete" pid="{{$faculty->id}}"><i class="fas fa-trash-alt"></i></a></td>
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
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" id="modal-ct">
        </div>
    </div>
</div>
@endsection
@section('link_js')
    <script>
        $(function(){
            $('#create').on('click',function(){
                $('#modal-ct').html(
                    '<form action="">' +
                        '<div class="modal-header">' +
                            '<h4 class="modal-title">Tạo mới</h4>' +
                            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                            '<div class="form-group">'+
                                '<label for="fac-id">Mã Khoa</label>'+
                                '<input type="text" id="fac-id" class="form-control">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="name">Tên Khoa</label>'+
                                '<input type="text" id="fac-name" class="form-control">'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label for="note">Note</label>'+
                                '<input type="text" id="fac-note" class="form-control">'+
                            '</div>'+
                        '</div>'+
                        '<div class="modal-footer">'+
                            '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="cre-submit">Lưu</button>'+
                            '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'+
                        '</div>'+
                    '</form>'
                );
                $('#cre-submit').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var id = $("#fac-id").val();
                    var name = $("#fac-name").val();
                    var note = $("#fac-note").val();

                    $.ajax({
                        type:'POST',
                        url:'/admin/faculty',
                        data:{id:id, name:name, note:note},
                        success:function(data){
                            alert(data.success);
                        }
                    });
                    $(document).ajaxStop(function(){
                        window.location.reload();
                    });
                });
            });
            $('.edit').on('click',function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var $pid = $(this).attr('pid');
                $.ajax({
                    type:'GET',
                    url:'/admin/faculty/'+$pid,
                    success:function(data){
                        $('#modal-ct').html(
                            '<form action="">' +
                                '<div class="modal-header">' +
                                    '<h4 class="modal-title">Sửa</h4>' +
                                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<div class="form-group">'+
                                        '<label for="fac-id">Mã Khoa</label>'+
                                        '<input type="text" id="fac-id" class="form-control" value="'+ data.id +'" disabled>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="name">Tên Khoa</label>'+
                                        '<input type="text" id="fac-name" class="form-control" value="'+data.name+'">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="note">Note</label>'+
                                        '<input type="text" id="fac-note" class="form-control" value="'+data.note+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="edt-submit">Lưu</button>'+
                                    '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'+
                                '</div>'+
                            '</form>'
                        );
                        $('#edt-submit').click(function(e){
                            var id = $("#fac-id").val();
                            var name = $("#fac-name").val();
                            var note = $("#fac-note").val();
                            $.ajax({
                                type:'PUT',
                                url:'/admin/faculty/'+$pid,
                                data:{id:id, name:name, note:note},
                                success:function(data){
                                    alert(data.success);
                                }
                            });
                            $(document).ajaxStop(function(){
                                window.location.reload();
                            });
                        });
                    }
                });
            });
            $('.delete').on('click',function(e){
                var $pid = $(this).attr('pid');
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'DELETE',
                    url:'/admin/faculty/'+$pid,
                    success:function(data){
                        alert(data);
                    }
                });
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            });
            var countChecked = function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $( "input[name='item[]']:checked" ).each(function(){
                    var $pid = $(this).attr('pid');
                    $.ajax({
                        type:'DELETE',
                        url:'/admin/faculty/'+$pid,
                    });
                });
                alert('Đã xóa thành công');
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            };
            $( "#delete-all" ).on( "click", countChecked );
        });
    </script>
@endsection