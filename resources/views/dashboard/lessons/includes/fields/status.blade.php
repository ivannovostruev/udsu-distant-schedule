@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="status" class="form-label">Статус</label>
<select name="status"
        id="status"
        class="form-select">
@foreach($lesson->getStatuses() as $key => $statusName)
    <option value="{{ $key }}"
            @if(old('status', $status) == $key) selected @endif>{{ $statusName }}
    </option>
@endforeach
</select>
