<table class="table table-striped table-hover table-bordered" id="table">
        <thead class="thead-light">
            <tr>
                <th>STT</th>
                <th class="width-100">Chi đoàn</th>
                <th class="width-200">Bí thư</th>
                <th class="width-200">Email</th>
                <th class="width-100">Điện thoại</th>
                <th class="width-80">Tác vụ</th>
                <th class="width-100">Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $key=>$classroom)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $classroom->id }}</td>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->email }}</td>
                    <td>{{ $classroom->phone }}</td>
                    <td class="text-center text-primary">
                        <a href="{{ action('StudentController@index', [$faculty_id, $classroom->id]) }}">
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
        {!! $classrooms->links() !!}
    </div>