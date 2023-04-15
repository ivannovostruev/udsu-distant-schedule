@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="type" class="form-label">Тип занятия*</label>
<select name="type"
        id="type"
        class="form-select">
@foreach($lesson->getTypes() as $key => $typeName)
    <option value="{{ $key }}"
            @if(old('type', $type) == $key) selected @endif>{{ $typeName }}
    </option>
@endforeach
</select>
