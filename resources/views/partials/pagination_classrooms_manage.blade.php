<input type="hidden" id="return_found_results" value="{{ $total_row }}">
<table class="table table-striped table-hover table-bordered" id="table">
    <thead class="thead-light">
        <tr>
            <th style="width:10px"></th>
            <th class="text-center" style="width:10px">STT</th>
            <th class="width-100">MÃ Lớp</th>
            <th class="width-100">Khoa</th>
            <th class="width-80">Cập nhật</th>
            <th class="text-center" colspan="2">Tác vụ</th>
        </tr>
    </thead>
    <tbody id="tb-body">
        @foreach ($classrooms as $key=>$classroom)
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>{{ $key+1 }}</td>
                <td>{{ $classroom->id }}</td>
                <td>{{ $classroom->name }}</td>
                <td>{{ $classroom->updated_at }}</td>
                <td class="text-center">
                    <a href="#" class="text-primary open_modal_classroom_to_edit"
                    classroom_id="{{ $classroom->id }}" fa_id="{{ $classroom->faculty_id }}"
                    data-toggle="modal" data-target="#modal_classroom">
                        <i class="fas fa-user-edit"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a href="#" class="text-danger delete_classroom" classroom_id="{{ $classroom->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination-container">
    {!! $classrooms->links() !!}
</div>