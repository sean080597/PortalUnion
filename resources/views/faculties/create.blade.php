@extends('layouts.app')

@section('show_tab')
<li class="breadcrumb-item"><a href="#">Tạo mới khoa</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h1>Create New Faculty</h1>
            <hr>
            <form action="{{ route('faculties.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="id">Mã Khoa</label>
                    <input id="id"  name="id" maxlength="4" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id') }}</strong>
                        </span>
                    @endif
                    <br>
                    <label for="name">Tên Khoa</label>
                    <input id="name"  name="name" maxlength="50" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <br>
                    <input type="submit" class="btn btn-success btn-lg btn-block" value="Tạo Khoa">
                </div>
            </form>
        </div>
    </div>
@endsection