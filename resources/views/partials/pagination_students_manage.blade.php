<input type="hidden" id="return_found_results" value="{{ $total_row }}">
<table class="table table-striped table-hover table-bordered" id="table">
        <thead class="thead-light">
            <tr>
                <th style="width:10px"></th>
                <th class="text-center">STT</th>
                <th class="width-80">MSSV</th>
                <th class="width-200">Tên</th>
                <th class="width-80">Chi Đoàn</th>
                <th class="width-200">Khoa</th>
                <th class="width-100">Cập nhật</th>
                <th class="width-80 text-center" colspan="3">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 0;
            @endphp
            @foreach ($students as $key => $student)
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center">{{ $key+1 }}</td>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class_room_id }}</td>
                <td>{{ $student->faculty_name }}</td>
                <td>{{ $student->updated_at }}</td>
                <td class="text-center">
                    <a href="{{ action('StudentController@manageshow',
                    [$student['id']]) }}" class="text-secondary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" class="text-primary">
                        <i class="fas fa-user-edit"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" class="text-danger delete_student_manage" stu_id="{{ $student->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            @php
                $count++;
            @endphp

            @endforeach
            <input type="text" id="stt_student" name="stt_student" style="display: none" value="{{ $count }}">
        </tbody>
    </table>
    <div class="pagination-container">
        {!! $students->links() !!}
    </div>