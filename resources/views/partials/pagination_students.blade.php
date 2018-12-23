<input type="hidden" id="return_found_results" value="{{ $total_row }}">
<table class="table table-striped table-hover table-bordered" id="table">
    <thead class="thead-light">
        <tr>
            <th>STT</th>
            <th class="width-100">MSSV</th>
            <th class="width-200">Họ Tên</th>
            <th class="width-100">Ngày sinh</th>
            <th class="width-200">Email</th>
            <th class="width-100">Điện thoại</th>
            <th class="width-80">Tác vụ</th>
            <th class="width-100">Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $key=>$student)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ Carbon\Carbon::parse($student->birthday)->format('d-m-Y') }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td class="text-center text-primary">
                    <a href="{{ action('StudentController@show', $student->id) }}">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td class="text-center">
                    <span class="badge badge-pill badge-secondary">hello</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-container">
    {!! $students->links() !!}
</div>