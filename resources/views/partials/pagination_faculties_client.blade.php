<table class="table table-striped table-hover table-bordered" id="table">
    <thead class="thead-light">
        <tr>
            <th>STT</th>
            <th class="width-100">Khoa</th>
            <th class="width-200">Bí thư</th>
            <th class="width-200">Email</th>
            <th class="width-100">Điện thoại</th>
            <th class="width-80">Tác vụ</th>
            <th class="width-100">Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $key => $faculty)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $faculty->faculty_name }}</td>
                <td>{{ $faculty->user_name}}</td>
                <td>{{ $faculty->email }}</td>
                <td>{{ $faculty->phone }}</td>
                <td class="text-center text-primary">
                    <a href="{{ action('ClassRoomController@index',
                    [$faculty->id]) }}">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td class="text-center">
                    <span class="badge badge-pill badge-secondary">{{ $faculty->note }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>