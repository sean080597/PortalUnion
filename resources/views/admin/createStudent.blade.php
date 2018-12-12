@extends('layouts.appAdmin')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="{{url('admin/student')}}">Đoàn viên</a></li>
@endsection

@section('link_js')
    <script src="{{ asset('theme/JS/student.js') }}" async></script>
    <script async>
        function set_faculty(){
            $.ajax({
                type:'POST',
                url:'create/get',
                success:function(data){
                    $('#faculty').html(function(){
                        var selected = '<option value="" selected>=== Chọn khoa ===</option>';
                        $.each(data.faculties,function(key,value){
                            selected = selected + '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        return selected;
                    });
                    
                }
            });
        }
        function get_data($id){
            var $mssv = $('#mssv').val();
            var $name = $('#name').val();
            //var img = $('#profile-img').val();
            var $birthday = $('#birthday').val();
            var $sex = $('#sex').val();
            var $union_date = $('#union_data').val();
            var $hometown = $('#hometown').val();
            var $ethnic = $('#ethnic').val();
            var $religion = $('#religion').val();
            var $is_submit = $('#is_submit').val();
            var $phonenum = $('#phonenum').val();
            var $email = $('#email').val();
            var $address = $('#address').val();
            var $class_room = $('#class_room').val();
            var $faculty = $('#faculty').val();
            var $father_name = $('#father_name').val();
            var $father_birthday = $('#father_birthday').val();
            var $father_job = $('#father_job').val();
            var $father_phone = $('#father_phone').val();
            var $mother_name = $('#mother_name').val();
            var $mother_birthday = $('#mother_birthday').val();
            var $mother_job = $('#mother_job').val();
            var $mother_phone = $('#mother_phone').val();
            $.ajax({
                type:'POST',
                url:'create/store',
                data:{
                    mssv:$mssv,
                    name:$name,
                    //img:$img,
                    birthday:$birthday,
                    sex:$sex,
                    union_date:$union_date,
                    hometown:$hometown,
                    ethnic:$ethnic,
                    religion:$religion,
                    is_submit:$is_submit,
                    phonenum:$phonenum,
                    email:$email,
                    address:$address,
                    class_room:$class_room,
                    //faculty:$faculty,
                    father_name:$father_name,
                    father_birthday:$father_birthday,
                    father_job:$father_job,
                    father_phone:$father_phone,
                    mother_name:$mother_name,
                    mother_birthday:$mother_birthday,
                    mother_job:$mother_job,
                    mother_phone:$mother_phone
                },
                success:function(msg){
                    alert(msg);
                }
            });
        }
        function create_student(){
            get_data();
            //history.back();
        }
        $(function(){
            $id = $('#mssv').val();
            $idC =$('#class_room').attr('name');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ajaxComplete(function(){
                call_tracking_input_search();
                call_tracking_select_all();
            });
            set_faculty();
            $('#btn-submit').click(function(){
                create_student();
                
            });
        })
    </script>
@endsection

@section('content')
<div class="container">
    <form action="" id="form-change-info-student" method="POST">
        @csrf
        <div class="row">
            <div class="input-group mb-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">MSSV</span>
                </div>
                <input type="text" class="form-control" id="mssv">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">Thông tin cá nhân</div>
                    <div class="card-body">
                       <div class="form-group">
                            <label for="image">Hình Ảnh</label>
                            <div class="wrap-avatar mb-1">
                                <a href="#" id="profile-img"><img class="img-fluid mb-3" src="{{ asset('theme/images/img_avatar1.png') }}" alt="Chania" width="30%"></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ Tên</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nguyễn Văn A">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sex">Giới tính</label>
                                    <select name="sex" id="sex" class="form-control">
                                        <option value="1" selected>Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="union_day">Ngày vào đoàn</label>
                                    <input type="date" class="form-control" name="union_day" id="union_day">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hometown">Quê quán</label>
                                    <input type="text" class="form-control" name="hometown" id="hometown">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ethnic">Dân tộc</label>
                                    <input type="text" class="form-control" name="ethnic" id="ethnic">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="religion">Tôn giáo</label>
                                    <input type="text" class="form-control" name="religion" id="religion">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="is_submit" id="is_submit">
                                    <label for="is_submit" class="form-check-label">
                                        Nộp sổ đoàn
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">SĐT</label>
                                    <input type="tel" class="form-control" name="phonenum" id="phonenum"
                                    maxlength="10"
                                    onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                                    onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="nguyenvana@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address" rows="3" class="form-control" placeholder="Số nhà, đường, phường/ xã"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">Thông tin khác</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="faculty">Đoàn khoa</label>
                            <select name="faculty" id="faculty" class="form-control" data-dependent="id">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class_room">Chi đoàn</label>
                            <select name="class_room" id="class_room" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-secondary text-white">Thông tin Cha</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="father_name">Họ tên</label>
                            <input type="text" class="form-control name="father_name" id="father_name">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="father_birthday">Ngày sinh</label>
                                    <input type="date" class="form-control" name="father_birthday" id="father_birthday">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="father_phone">Điện thoại</label>
                                    <input type="text" class="form-control" name="father_phone" id="father_phone"
                                    maxlength="10"
                                    onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                                    onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="father_job">Công việc</label>
                            <input type="text" class="form-control" name="father_job" id="father_job">
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header bg-secondary text-white">Thông tin Mẹ</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="mother_name">Họ tên</label>
                            <input type="text" class="form-control" name="mother_name" id="mother_name">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mother_birthday">Ngày sinh</label>
                                    <input type="date" class="form-control" name="mother_birthday" id="mother_birthday">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mother_phone">Điện thoại</label>
                                    <input type="text" class="form-control" name="mother_phone" id="mother_phone"
                                    maxlength="10"
                                    onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                                    onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mother_job">Công việc</label>
                            <input type="text" class="form-control" name="mother_job" id="mother_job">
                        </div>
                    </div>
                </div>
            </div>
            <input type="text" id="student_id" name="student_id" style="display: none">
            <input type="text" id="user_id" name="user_id" style="display: none">
            <button type="submit" class="btn btn-success mx-auto mt-3" id="btn-submit">Tạo mới</button>
        </div>
    </form>
</div>

{{-- modal change profile image --}}
<div class="modal fade" id="modal_change_image">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Sửa ảnh đại diện</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="offset-3 col-6">
                        <img class="img-thumbnail" id="profile-img-to-change" src="{{ !empty($student->image) ? asset('images/'.$student->image) : asset('theme/images/img_avatar1.png') }}" alt="profile image" width="100%">
                        <p></p>
                    </div>
                    <br>
                    <div class="col-12">
                        <form action="" id="uploadimage_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="current_img" id="current_img" style="display: none" value="{{ !empty($student->image) ? $student->image : '' }}">
                            <input type="file" accept="image/*" name="select_file" id="select_file" class="col-6" style="margin:0 auto; display: block;">
                            <span id="error-null-file" style="display: none; text-align:center; color: red; font-weight: 600">Hãy chọn 1 hình hoặc thoát!</span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="btn_change_image">Sửa</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
@endsection