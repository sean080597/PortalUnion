@extends('layouts.app')

@section('link_css')
<link rel="stylesheet" href="{{ asset('theme/CSS/index.css') }}">
@endsection

@section('content')
<div class="wrapper d-flex flex-column">
    <section class="task">
        <h5>
            <i class="fas fa-tasks"></i>
             Công việc cần làm
            <span class="badge badge-primary">1</span>
        </h5>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped     table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="width:80px">STT</th>
                                <th class="text-center" style="min-width:160px">Năm học</th>
                                <th class="text-left" style="min-width:330px">Công việc</th>
                                <th class="text-center" style="min-width:160px">Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">1</th>
                                <th class="text-center">2015-2016</th>
                                <th class="text-left"><a href="dashboard.html">Đóng tiền đoàn phí năm học 2015-2016</a></th>
                                <th class="text-center"><span class="badge badge-pill badge-success">Xong</span></th>
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <th class="text-center">2016-2017</th>
                                <th class="text-left"><a href="dashboard.html">Đóng tiền đoàn phí năm học 2016-2017</a></th>
                                <th class="text-center"><span class="badge badge-pill badge-success">Xong</span></th>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <th class="text-center">2017-2018</th>
                                <th class="text-left"><a href="dashboard.html">Đóng tiền đoàn phí năm học 2017-2018</a></th>
                                <th class="text-center"><span class="badge badge-pill badge-warning">Chưa</span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="message">
        <h5>
            <i class="fas fa-bullhorn"></i>
            <span> Thông báo</span>
        </h5>
        <section class="wrapper d-flex flex-column">
            <article class="message-item">
                <form action="/" class="form-group">
                    <label for="title">Title</label>
                    <textarea name="title" id="title" class="form-control" rows="5" disabled>
                        HEllo<br>hello<br>Xem hướng dẫn
                    </textarea>
                </form>
                <ul class="row list-unstyled">
                    <li class="col-md-3">
                        <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/2DBcmzKfdx8?rel=0"></iframe>
                        </div>
                    </li>
                    <li class="col-md-3">
                        <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/2DBcmzKfdx8?rel=0"></iframe>
                        </div>
                    </li>
                    <li class="col-md-3"></li>
                    <li class="col-md-3"></li>
                </ul>
            </article>
            <article class="message-item">
                    <form action="/" class="form-group">
                        <label for="title">Title</label>
                        <textarea name="title" id="title1" class="form-control" rows="5" disabled>
                            HEllo<br>hello<br>xem hướng dẫn
                        </textarea>
                    </form>
                    <ul class="row list-unstyled">
                        <li class="col-md-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/2DBcmzKfdx8?rel=0"></iframe>
                            </div>
                        </li>
                        <li class="col-md-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/2DBcmzKfdx8?rel=0"></iframe>
                            </div>
                        </li>
                        <li class="col-md-3"></li>
                        <li class="col-md-3"></li>
                    </ul>
                </article>
        </section>
    </section>
</div>
@endsection
