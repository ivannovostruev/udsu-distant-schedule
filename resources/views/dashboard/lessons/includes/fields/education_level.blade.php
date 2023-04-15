@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="education-level" class="form-label">Уровень образования*</label>
<select name="education_level"
        id="education-level"
        class="form-select">
@if(empty($educationLevel))
    <option disabled selected>не выбрано</option>
@endif
@foreach($lesson->getEducationLevels() as $key => $educationLevelName)
    <option value="{{ $key }}"
            @if(old('education_level', $educationLevel) == $key) selected @endif>{{ $educationLevelName }}
    </option>
@endforeach
</select>
