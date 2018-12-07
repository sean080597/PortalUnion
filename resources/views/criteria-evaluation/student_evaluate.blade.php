@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">QL trường</a></li>
<li class="breadcrumb-item"><a href="#">Tác vụ</a></li>
@endsection

@section('content')
<div class="wrap-table">
    <div class="note-info">
        <div class="row">
            <div class="col-sm-6"><p><span>Tên: </span>{{ $student->name }}</p></div>
            <div class="col-sm-6"><p><span>MSSV: </span>{{ $student->id }}</p></div>
            <div class="col-sm-6"><p><span>Chi đoàn: </span>{{ $student->class_room_id }}</p></div>
            <div class="col-sm-6"><p><span>Khoa: </span>{{ $faculty->name }}</p></div>
        </div>
    </div>
    <div class="note-warning">
        <div class="row">
            <div class="col-sm"><p><span>ĐV: </span>đoàn viên</p></div>
            <div class="col-sm"><p><span>CĐ: </span>Bí thư chi đoàn</p></div>
            <div class="col-sm"><p><span>Khoa: </span>Bí thư đoàn khoa</p></div>
            <div class="col-sm"><p><span>Trường: </span>Bí thư đoàn trường</p></div>
        </div>
    </div>
    <form action="">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="table">
                <thead class="thead-light">
                    <tr>
                        <th rowspan="2" style="min-width:60%">Nội dung</th>
                        <th rowspan="2" style="width:140px" class="text-center">ĐV tự dánh giá</th>
                        <th colspan="4">Đánh Giá</th>
                    </tr>
                    <tr>
                        <th class="text-center">ĐV</th>
                        <th class="text-center">CĐ</th>
                        <th class="text-center">Khoa</th>
                        <th class="text-center">Trường</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" style="font-weight:700"><span>I. </span> Nội dung đoàn viên đăng ký thực hiện theo yêu cầu chung của đoàn trường<span> (Tối đa: 70đ)</span></td>
                    </tr>
                    @foreach ($cri_mandatory as $key => $cri)
                    <tr>
                        <td>
                            <span>{{ ++$key }}. </span>
                            <span>{{ $cri->content }}</span>
                        </td>
                        <td class="text-center p-1">
                            <input type="text" class="form-control">
                        </td>
                        <td class="text-center p-1">
                            <input type="number" value="0" style="width:55px" class="form-control" min="0" max="10"
                            onkeyup="return this.value > 10 ? this.value=10 : true">
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" style="font-weight:700"><span>II. </span> Nội dung đoàn viên tự đăng ký thực hiên<span> (Tối đa: 30đ)</span></td>
                    </tr>
                    @foreach ($cri_selfregis as $key => $cri)
                    <tr>
                        <td class="p-1">
                            <span style="margin: 5px;">{{ ++$key }}. {{ $cri->content }}</span>
                            <p></p>
                            <textarea class="form-control" rows="3" id=""></textarea>
                        </td>
                        <td class="text-center p-1">
                            <input type="text" class="form-control">
                        </td>
                        <td class="text-center p-1">
                                <input type="number" value="0" style="width:55px" class="form-control" min="0" max="10"
                                onkeyup="return this.value > 10 ? this.value=10 : true">
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Xác nhận</button>
            </div>
        </div>
    </form>
</div>
@endsection