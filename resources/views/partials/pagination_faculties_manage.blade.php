<table class="table table-striped table-hover table-bordered" id="table">
    <thead class="thead-light">
        <tr>
            <th style="width:10px"></th>
            <th class="text-center" style="width:10px">STT</th>
            <th class="width-100">MÃ Khoa</th>
            <th class="width-200">Tên Khoa</th>
            <th>Nhánh</th>
            <th class="width-100">Cập nhật</th>
            <th class="text-center" colspan="2">Tác vụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $key => $faculty)
        <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td class="text-center">{{ ++$key }}</td>
            <td>{{ $faculty->id }}</td>
            <td>{{ $faculty->name }}</td>
            <td>{{ $faculty->note }}</td>
            <td>{{ $faculty->updated_at }}</td>
            <td class="text-center">
                <a href="#" class="text-primary open_modal_faculty_to_edit" data-toggle="modal"
                data-target="#modal_adjust_faculty" faculty_id="{{ $faculty->id }}">
                    <i class="fas fa-user-edit"></i>
                </a>
            </td>
            <td class="text-center">
                <a href="#" class="text-danger delete_faculty" faculty_id="{{ $faculty->id }}">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>