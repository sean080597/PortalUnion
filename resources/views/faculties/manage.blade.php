@extends('layouts.app')

@section('show_tab')
<li class="breadcrumb-item"><a href="#">DS Khoa</a></li>
@endsection

@section('content')
<div class="col-lg-12">
    <h2><i class="fa fa-key"></i> Faculties</h2>
    <hr>
    <a href="{{ URL::to('faculties/create') }}" class="btn btn-success">Add Faculty</a>
    <p></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã Khoa</th>
                    <th>Tên Khoa</th>
                    <th>Nhánh</th>
                    <th>Ngày cập nhật</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ $faculty->note }}</td>
                    <td>{{ $faculty->created_at }}</td>
                    <td>
                    <a href="{{ URL::to('faculties/'.$faculty->id.'/edit') }}" class="btn btn-sm btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    <button class="btn btn-sm btn-danger delete_faculty" type="button" faculty_id="{{ $faculty->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection