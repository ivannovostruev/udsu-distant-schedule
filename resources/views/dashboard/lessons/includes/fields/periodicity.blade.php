@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="periodicity" class="form-label">Периодичность</label>
<select name="periodicity"
        id="periodicity"
        class="form-select">
    @foreach($lesson->getAllKindsPeriodicity() as $key => $periodicityName)
        <option value="{{ $key }}"
                @if(old('periodicity', $periodicity) == $key) selected @endif>{{ $periodicityName }}
        </option>
    @endforeach
</select>
