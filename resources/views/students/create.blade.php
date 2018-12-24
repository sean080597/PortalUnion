@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="{{url('admin/student')}}">Đoàn viên</a></li>
@endsection

@section('link_js')
<script src="{{ asset('theme/JS/student.js') }}" async></script>
@endsection

@section('content')
<div class="container">
    <form action="" id="form-create-student" method="POST">
        @csrf
        <div class="row">
            <div class="input-group mb-3 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">MSSV</span>
                </div>
                <input type="text" class="form-control" name="mssv" id="mssv"
                maxlength="10" required
                onkeypress="return event.keyCode>47 && event.keyCode<58 ? true : false"
                onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                >
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
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nguyễn Văn A" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday" required>
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
                                    onkeypress="return event.keyCode>47 && event.keyCode<58 ? true : false"
                                    onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                                    required>
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
                            <select name="sel-faculty" id="sel-faculty" class="form-control">
                                <option value="0" disabled selected>=== Chọn Khoa / Viện ===</option>
                                @foreach ($all_faculties as $single_faculty)
                                    <option value="{{ $single_faculty->id }}">{{ $single_faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="class_room">Chi đoàn</label>
                            <select name="sel-class_room" id="sel-class_room" class="form-control">
                                <option value="0" disabled selected>=== Chọn Lớp ===</option>
                                //show dependent dropdown classrooms
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-secondary text-white">Thông tin Cha</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="father_name">Họ tên</label>
                            <input type="text" class="form-control" name="father_name" id="father_name">
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
                                    onkeypress="return event.keyCode>47 && event.keyCode<58 ? true : false"
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
                                    onkeypress="return event.keyCode>47 && event.keyCode<58 ? true : false"
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
                            <input type="file" accept='image/*' name="select_file" id="select_file" class="col-6" style="margin:0 auto; display: block;">
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