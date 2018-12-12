@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/ThongTin.css') }}">
@endsection

@section('show_tab')
<li class="breadcrumb-item"><a href="#">QL trường</a></li>
<li class="breadcrumb-item"><a href="#">Tác vụ</a></li>
@endsection

@section('link_js')
<script src="{{ asset('theme/JS/criteria.js') }}" async></script>
@endsection

@section('content')
<div class="wrap-table">
    <div class="note-info">
        <div class="row">
            <div class="col-sm-6"><p><span>Tên: </span>{{ $showed_student->name }}</p></div>
            <div class="col-sm-6"><p><span>MSSV: </span>{{ $showed_student->id }}</p></div>
            <div class="col-sm-6"><p><span>Chi đoàn: </span>{{ $showed_student->class_room_id }}</p></div>
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
    <form action="" id="form-submit-criteria-evaluation" method="POST">
        @csrf
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
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($cri_mandatory as $key => $cri)
                    <tr>
                        <td>
                            <span>{{ ++$key }}. </span>
                            <span id="cri_man_id_{{ $cri->id }}" criman_id="{{ $cri->id }}">{{ $cri->content }}</span>
                        </td>
                        @if (auth()->user()->role_id == 'stu'
                        || (auth()->user()->role_id == 'cla' && $showed_student->id == $logged_student->id)
                        || (auth()->user()->role_id == 'fac' && $showed_student->id == $logged_student->id))
                        <td class="text-center">
                            <input type="text" class="form-control"
                            value="{{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->self_assessment : '' }}"
                            id="cri_man_selfassess_{{ $cri->id }}"
                            name="cri_man_selfassess_{{ $cri->id }}" required>
                        </td>
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_student : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : true"
                            id="cri_man_markstu_{{ $cri->id }}" name="cri_man_markstu_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->self_assessment : ''}}
                        </td>
                        <td class="text-center">
                            {{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_student : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'cla')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_classroom : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : true"
                            id="cri_man_markcla_{{ $cri->id }}" name="cri_man_markcla_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_classroom : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'fac')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_faculty : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : true"
                            id="cri_man_markfac_{{ $cri->id }}" name="cri_man_markfac_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_faculty : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'sch')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_school : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : true"
                            id="cri_man_marksch_{{ $cri->id }}" name="cri_man_marksch_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_criman[$count]) ? $ls_stu_criman[$count]->mark_school : '0'}}
                        </td>
                        @endif
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="6" style="font-weight:700"><span>II. </span> Nội dung đoàn viên tự đăng ký thực hiện<span> (Tối đa: 30đ)</span></td>
                    </tr>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($cri_selfregis as $key => $cri)
                    <tr>
                        <td class="p-1">
                            <span style="margin: 5px;" id="cri_sel_id_{{ $cri->id }}" crisel_id="{{ $cri->id }}">
                                {{ ++$key }}. {{ $cri->content }}
                            </span>
                            <p></p>
                            @if (auth()->user()->role_id == 'stu'
                            || (auth()->user()->role_id == 'cla' && $showed_student->id == $logged_student->id)
                            || (auth()->user()->role_id == 'fac' && $showed_student->id == $logged_student->id))
                            <textarea class="form-control" rows="3"
                            id="cri_sel_content_{{ $cri->id }}"
                            name="cri_sel_content_{{ $cri->id }}" required>{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->content_regis : '' }}</textarea>
                            @else
                            <span>{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->content_regis : '' }}</span>
                            @endif
                        </td>

                        @if (auth()->user()->role_id == 'stu'
                        || (auth()->user()->role_id == 'cla' && $showed_student->id == $logged_student->id)
                        || (auth()->user()->role_id == 'fac' && $showed_student->id == $logged_student->id))
                        <td class="text-center">
                            <input type="text" class="form-control"
                            value="{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->self_assessment : ''}}"
                            id="cri_sel_selfassess_{{ $cri->id }}" name="cri_sel_selfassess_{{ $cri->id }}" required>
                        </td>
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_student : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : (this.value == '' ? this.value=0 : true)"
                            id="cri_sel_markstu_{{ $cri->id }}" name="cri_sel_markstu_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->self_assessment : ''}}
                        </td>
                        <td class="text-center">
                            {{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_student : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'cla')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_classroom : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : (this.value == '' ? this.value=0 : true)"
                            id="cri_sel_markcla_{{ $cri->id }}" name="cri_sel_markcla_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_classroom : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'fac')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_faculty : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : (this.value == '' ? this.value=0 : true)"
                            id="cri_sel_markfac_{{ $cri->id }}" name="cri_sel_markfac_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_faculty : '0'}}
                        </td>
                        @endif

                        @if (auth()->user()->role_id == 'sch')
                        <td class="text-center">
                            <input type="number" style="width:55px" class="form-control" min="0" max="10"
                            value="{{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_school : '0'}}"
                            onkeyup="return this.value > 10 ? this.value=10 : (this.value == '' ? this.value=0 : true)"
                            id="cri_sel_marksch_{{ $cri->id }}" name="cri_sel_marksch_{{ $cri->id }}" required>
                        </td>
                        @else
                        <td class="text-center">
                            {{ !empty($ls_stu_crisel[$count]) ? $ls_stu_crisel[$count]->mark_school : '0'}}
                        </td>
                        @endif
                    </tr>
                    @php
                        $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <input type="text" id="role_id" name="role_id" value="{{ auth()->user()->role_id }}" style="display: none">
                <input type="text" id="student_id" name="student_id" value="{{ $showed_student->id }}" style="display: none">
                <button class="btn btn-success" type="submit">Xác nhận</button>
            </div>
        </div>
    </form>
</div>
@endsection