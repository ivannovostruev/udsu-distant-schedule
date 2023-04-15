@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="teacher-id" class="form-label">Преподаватель*</label>
<select name="teacher_id"
        id="teacher-id"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($teachers as $teacher)
        @php /** @var \App\Models\Schedule\Teacher $teacher */ @endphp
        <option value="{{ $teacher->id }}"
                @if(old('teacher_id', $teacherId) == $teacher->id) selected @endif>{{ $teacher->full_name }}
        </option>
    @endforeach
</select>
