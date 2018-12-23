<option value="0" disabled selected>=== Chọn Khoa / Viện ===</option>
@if ($faculty_id == null)
    @foreach ($faculties as $faculty)
        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
    @endforeach
@else
    @foreach ($faculties as $faculty)
        <option value="{{ $faculty->id }}" {{($faculty->id == $faculty_id)?'selected':''}}>{{ $faculty->name }}</option>
    @endforeach
@endif