@extends('layouts.appAdmin')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href={{url('/admin/class')}}>DS Lớp</a></li>
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
            <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#myModal" id="create"><i class="fas fa-plus-circle"></i> Thêm lớp</a>
        </div>
    </div>

    <div class="table-responsive">
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
        function edit(){
            $('.edit').on('click',function(e){
                var $pid = $(this).attr('pid');
                $.ajax({
                    type:'GET',
                    url:'/admin/getToEdit/'+$pid,
                    success:function(dt){
                        $('#modal-ct').html(
                            '<form action="">' +
                                '<div class="modal-header">' +
                                    '<h4 class="modal-title">Tạo mới</h4>' +
                                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<div class="form-group">'+
                                        '<label for="class-id">Mã Lớp</label>'+
                                        '<input type="text" id="class-id" class="form-control" value="'+dt.class.id+'" disabled>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="class-id">Khoa</label>'+
                                        '<select id="sl-fac" class="form-control">'+
                                            '<option value="'+dt.class.faculty_id+'">'+dt.class.faculty_name+'</option>'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="edt-submit">Lưu</button>'+
                                    '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'+
                                '</div>'+
                            '</form>'
                        );
                        $.each(dt.faculties,function(key,value){
                            $('#sl-fac').append(
                                '<option value="'+value.id+'">'+value.name+'</option>'
                            );
                        })
                        $('#edt-submit').click(function(e){
                            var pid = $("#class-id").val();
                            var fac_id = $("#sl-fac").val();
                            $.ajax({
                                type:'PUT',
                                url:'/admin/class/'+$pid,
                                data:{faculty_id:fac_id},
                                success:function(data){
                                    alert(data.success);
                                    location.reload();
                                }
                            });
                        });
                    }
                });
            });
        }
        function deleteOne(){
            $('.delete').on('click',function(e){
                var $pid = $(this).attr('pid');
                e.preventDefault();
                $.ajax({
                    type:'DELETE',
                    url:'/admin/class/'+$pid,
                    success:function(data){
                        alert(data);
                        location.reload();
                    }
                });
            });
        }
        function deleteAll(){
            var countChecked = function() {
                $( "input[name='item[]']:checked" ).each(function(){
                    var $pid = $(this).attr('pid');
                    $.ajax({
                        type:'DELETE',
                        url:'/admin/class/'+$pid,
                    });
                });
                alert('Đã xóa thành công');
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
            };
            $( "#delete-all" ).on( "click", countChecked );
        }
        function loadajax(){
            $.ajax({
                type:'GET',
                url:'/admin/getAllClass',
                success:function(dt){
                    $.each(dt.data,function(key,value){
                        $('#tb-body').append(
                            '<tr>'+
                                '<td class="text-center"><input type="checkbox" name="item[]" pid="'+value.id+'"></td>'+
                                '<td class="text-center">'+(key+1)+'</td>'+
                                '<td>'+value.id+'</td>'+
                                '<td>'+value.faculty_name+'</td>'+
                                '<td>'+value.updated_at+'</td>'+
                                '<td class="text-center"><a href="#" class="text-primary edit" data-toggle="modal" data-target="#myModal" pid="'+value.id+'"><i class="fas fa-user-edit"></i></a></td>'+
                                '<td class="text-center"><a href="#" class="text-danger delete" pid="'+value.id+'"><i class="fas fa-trash-alt"></i></a></td>'+
                            '</tr>'
                        );
                    });
                    call_tracking_input_search();
                    call_tracking_select_all();
                    edit();
                    deleteOne();
                    deleteAll();
                }
            });
        }
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            loadajax();
            $('#create').on('click',function(){
                $.ajax({
                    type:'GET',
                    url:'/admin/getFaculties',
                    success:function(data){
                        $('#modal-ct').html(
                            '<form action="">' +
                                '<div class="modal-header">' +
                                    '<h4 class="modal-title">Tạo mới</h4>' +
                                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                                '</div>' +
                                '<div class="modal-body">' +
                                    '<div class="form-group">'+
                                        '<label for="class-id">Mã Lớp</label>'+
                                        '<input type="text" id="class-id" class="form-control">'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="class-id">Khoa</label>'+
                                        '<select id="sl-fac" class="form-control">'+
                                            
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="cre-submit">Lưu</button>'+
                                    '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'+
                                '</div>'+
                            '</form>'
                        );
                        data.forEach(element => {
                            $('#sl-fac').append(
                                '<option value="'+element.id+'">'+element.name+'</option>'
                            );
                        });
                        $('#cre-submit').click(function(){
                            var class_id = $("#class-id").val();
                            var fac_id = $('#sl-fac').val();
                            $.ajax({
                                type:'POST',
                                url:'/admin/class',
                                data:{id:class_id,faculty_id:fac_id},
                                success:function(data){
                                    alert(data.success);
                                }
                            });
                            $(document).ajaxStop(function(){
                                loadajax();
                            });
                        });
                    }
                });
            });
        });
    </script>
@endsection