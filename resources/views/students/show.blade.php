@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">TT cá nhân</a></li>
@endsection

@section('link_js')
    <script src="{{ asset('theme/JS/student.js') }}"></script>
@endsection

@section('content')
<section class="row">
    <section class="col-lg-3 d-flex flex-column align-items-center">
        <a href="#" id="profile-img"><img class="img-fluid mb-3" src="{{ !empty($student->image) ? asset('images/'.$student->image) : asset('theme/images/img_avatar1.png') }}" alt="Chania" width="120"></a>
        <div class="note-success">
            <p>Cập nhật gần nhất: {{ $student->updated_at->format('G\h i') }} ngày {{ $student->updated_at->format('d/m/Y') }}</p>
        </div>
        <div class="note-info">
            <p>Yêu cầu chỉnh sửa các thông tin khác xin liên hệ:</p>
            <ul>
                <li><p>PHÒNG CÔNG TÁC SINH VIÊN</p></li>
                <li><p>Trụ sở: 475A (số cũ:144/24) Điện Biên Phủ, P.25, Q.Bình Thạnh, TP.HCM</p></li>
                <li><p>ĐT: (028) 3 5120782</p></li>
                <li><p>Fax: (028) 3 5120784</p></li>
                <li><a href="http://daotao.hutech.edu.vn/" target="_blank">daotao@hutech.edu.vn</a></li>
            </ul>
        </div>
        <div class="note-warning">
            <p>Lưu ý: <span class="text-danger">(*)</span> Dữ liệu không được phép để trống</p>
        </div>
    </section>
    <form method="POST" action="" class="col-lg-9 d-flex flex-column align-items-center" id="form-change-info-student">
        @csrf
        <div class="row info-section">
            <div class="col-md-6">Mã số sinh viên: <span class="font-weight-bold">{{ $student->id }}</span> </div>
            <div class="col-md-6">Họ và tên: <span class="font-weight-bold">{{ $student->name }}</span> </div>
            <div class="col-md-6">Lớp: <span class="font-weight-bold">{{ $student->class_room_id }}</span> </div>
            <div class="col-md-6">Ngày sinh: <span>{{ Carbon\Carbon::parse($student->birthday)->format('d-m-Y') }}</span> </div>
            <div class="col-md-6">Khoa: <span class="font-weight-bold">{{ $faculty->name }}</span> </div>
            <div class="col-md-6">Niên khóa: <span>2015-2019</span> </div>
            <div class="col-md-6">Chuyên ngành: <span class="font-weight-bold">{{ $faculty->name }}</span> </div>
        </div>
        <div class="info-section">
            <h5>Thông tin sinh viên</h5>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="sex">Giới tính <span class="text-danger">(*)</span></label>
                    <select name="sex" id="sex" class="form-control">
                        <option value="-1" disabled>Chọn giới tính</option>
                        @if($student->sex == 1)
                        <option value="1" selected>Nam</option>
                        <option value="0">Nữ</option>
                        @else
                        <option value="1">Nam</option>
                        <option value="0" selected>Nữ</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="hometown">Nơi sinh: <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="hometown" id="hometown" value="{{ !empty($student->hometown) ? $student->hometown : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email: <span class="text-danger">(*)</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phonenum">Điện thoại: <span class="text-danger">(*)</span></label>
                    <input type="tel" class="form-control" name="phonenum" id="phonenum"
                    value="{{ $student->phone }}" maxlength="10"
                    onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                    onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="doan">Ngày vào đoàn: <span class="text-danger">(*)</span></label>
                    <input type="date" class="form-control" name="doan" id="doan" value="{{ !empty($student->union_date) ? $student->union_date : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="dantoc">Dân tộc:</label>
                    <input type="text" class="form-control" name="dantoc" id="dantoc" value="{{ !empty($student->ethnic) ? $student->ethnic : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="tongiao">Tôn giáo:</label>
                    <input type="text" class="form-control" name="tongiao" id="tongiao" value="{{ !empty($student->religion) ? $student->religion : '' }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="vanhoa">Trình độ văn hóa: <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="vanhoa" id="vanhoa" value="12 / 12" disabled>
                </div>
            </div>
        </div>
        <div class="info-section">
            <h5>Địa chỉ liên lạc</h5>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="tp">Tỉnh/TP <span class="text-danger">(*)</span></label>
                    <select name="tp" id="tp" class="form-control">
                        <option value="-1" selected>Chọn Tỉnh / TP</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="quan">Quận/ Huyện <span class="text-danger">(*)</span></label>
                    <select name="quan" id="quan" class="form-control">
                        <option value="-1" selected>Chọn Quận/ Huyện</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="diachi">Địa chỉ <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" name="diachi" id="diachi" placeholder="Số nhà, đường, phường/ xã">
                </div>
            </div>
        </div>
        <div class="info-section">
            <h5>Thông tin nhân thân</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tencha">Họ tên cha: <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control {{ (empty($dad->name) || $dad->name == 'NO NAMED')?'text-danger border-danger':'' }}" name="tencha" id="tencha" value="{{ !empty($dad->name)?$dad->name:'' }}">
                    </div>
                    <div class="form-group">
                        <label for="ngaysinhcha">Ngày sinh: <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control" name="ngaysinhcha" id="ngaysinhcha" value="{{ !empty($dad->birthday) ? $dad->birthday : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="nghenghiepcha">Nghề nghiệp: </label>
                        <input type="text" class="form-control" name="nghenghiepcha" id="nghenghiepcha" value="{{ !empty($dad->job)?$dad->job:'' }}">
                    </div>
                    <div class="form-group">
                        <label for="dienthoaicha">Điện thoại: <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="dienthoaicha" id="dienthoaicha"
                        value="{{ !empty($dad->phone)?$dad->phone:'' }}" maxlength="10"
                        onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                        onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tenme">Họ tên mẹ: <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control {{ (empty($mom->name) || $mom->name == 'NO NAMED')?'text-danger border-danger':'' }}" name="tenme" id="tenme" value="{{ !empty($mom->name)?$mom->name:'' }}">
                    </div>
                    <div class="form-group">
                        <label for="ngaysinhme">Ngày sinh: <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control" name="ngaysinhme" id="ngaysinhme" value="{{ !empty($mom->birthday) ? $mom->birthday : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="nghenghiepme">Nghề nghiệp: </label>
                        <input type="text" class="form-control" name="nghenghiepme" id="nghenghiepme" value="{{ !empty($mom->job)?$mom->job:'' }}">
                    </div>
                    <div class="form-group">
                        <label for="dienthoaime">Điện thoại: <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" name="dienthoaime" id="dienthoaime"
                        value="{{ !empty($mom->phone)?$mom->phone:'' }}" maxlength="10"
                        onkeypress="return event.keyCode>48 && event.keyCode<57 ? true : false"
                        onkeydown="return event.keyCode == 69 || event.keyCode == 189 ? false : true"
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="info-section">
            <input type="text" id="student_id" name="student_id" value="{{ $student->id }}" style="display: none">
            <input type="text" id="user_id" name="user_id" value="{{ $student->user_id }}" style="display: none">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
    </form>
</section>

<!-- The Modal -->
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