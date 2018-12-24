@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="{{url('admin/user')}}">QL tài khoản</a></li>
@endsection
@section('link_js')
    <script>
        function showUser(){
            $.ajax({
                type:'GET',
                url:'/admin/user/showAll',
                success:function(dt){
                    $.each(dt.data,function(key,value){
                        $('#tb-body').append(
                            '<tr>'+
                                '<td class="text-center"><input type="checkbox" name="item[]" pid="'+value.id+'"></td>'+
                                '<td class="text-center">'+(key+1)+'</td>'+
                                '<td>'+value.name+'</td>'+
                                '<td>'+value.email+'</td>'+
                                '<td>'+value.role+'</td>'+
                                '<td>'+value.updated_at+'</td>'+
                                '<td class="text-center"><a href="#" class="text-primary edit" pid="'+value.id+'" data-toggle="modal" data-target="#myModal"><i class="fas fa-user-edit"></i></a></td>'+
                                '<td class="text-center"><a href="#" class="text-danger delete" pid="'+value.id+'"><i class="fas fa-trash-alt"></i></a></td>'+
                            '</tr>'
                        );
                    });
                    $('.edit').on('click',function(){
                        $id = $(this).attr('pid');
                        getUser($id);
                        $('#title').html('Cập nhật');
                        $('.modal-footer').html(
                            '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="update-submit">Lưu</button>'+
                            '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'
                        );
                        $('#update-submit').on('click',function(){
                            $name = $('#user-name').val();
                            $email = $('#user-email').val();
                            $password = $('#user-pwd').val();
                            $role_id = $('#user-role').val();
                            updateUser($id,$name,$email,$password,$role_id);
                        });
                    });
                    $('.delete').on('click',function(){
                        var id = $(this).attr('pid');
                        if(confirm("Bạn có muốn xóa tài khoản này không?")){
                            deleteUser(id);
                        }
                    });
                }
            });
        }
        function createUser($name,$email,$password,$role_id){
            $.ajax({
                type:'POST',
                url:'user/create',
                data:{
                    name:$name,
                    email:$email,
                    password:$password,
                    role_id:$role_id
                },
                success:function(data){
                    alert(data);
                    location.reload();
                }
            });
        }
        function updateUser($id,$name,$email,$password,$role_id){
            $.ajax({
                type:'PUT',
                url:'user/'+$id,
                data:{
                    name:$name,
                    email:$email,
                    password:$password,
                    role_id:$role_id
                },
                success:function(data){
                    alert('Cập nhật thành công');
                    location.reload();
                }
            });
        }
        function getRole(){
            $.ajax({
                type:'GET',
                url:'role/showAll',
                success:function(data){
                    var $string = "";
                    $.each(data,function(key,value){
                        $string = $string + '<option value="'+value.id+'">'+value.name+'</option>'
                    })
                    $('#user-role').html(function(){
                        return $string;
                    });
                }
            });
        }
        function getUser($id){
            $.ajax({
                type:'GET',
                url:'user/'+$id,
                success:function(data){
                    $('#user-name').val(data.name);
                    $('#user-email').val(data.email);
                }
            });
        }
        function deleteUser(id){
            $.ajax({
                type:'DELETE',
                url:'user/'+id,
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
            showUser();
            getRole();
            $('#create').on('click',function(){
                $('#title').html('Tạo tài khoản');
                $('.modal-footer').html(
                    '<button type="submit" class="btn btn-primary" data-dismiss="modal" id="cre-submit">Lưu</button>'+
                    '<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>'
                );
                $('#cre-submit').on('click',function(){
                    $name = $('#user-name').val();
                    $email = $('#user-email').val();
                    $password = $('#user-pwd').val();
                    $role_id = $('#user-role').val();
                    createUser($name,$email,$password,$role_id);
                });
            });
        });
    </script>
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
                <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#myModal" id="create"><i class="fas fa-plus-circle"></i> Thêm tài khoản</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="table">
                <thead class="thead-light">
                    <tr>
                        <th style="width:10px"></th>
                        <th class="text-center">STT</th>
                        <th class="width-80">Tên</th>
                        <th class="width-200">email</th>
                        <th class="width-200">Chức vụ</th>
                        <th class="width-100">Cập nhật</th>
                        <th class="width-80 text-center" colspan="2">Tác vụ</th>
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
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" id="modal-ct">
                <form action="">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user-name">Tên</label>
                            <input type="text" id="user-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-email">Email</label>
                            <input type="text" id="user-email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-pwd">Password</label>
                            <input type="text" id="user-pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user-role">Chức vụ</label>
                            <select id="user-role" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
