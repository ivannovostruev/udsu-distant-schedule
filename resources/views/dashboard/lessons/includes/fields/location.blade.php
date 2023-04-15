@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="location" class="form-label">Место проведения*</label>
<select name="location"
        id="location"
        class="form-select">
@foreach($lesson->getLocations() as $key => $locationName)
    <option value="{{ $key }}"
            @if(old('location', $location) == $key) selected @endif>{{ $locationName }}
    </option>
@endforeach
</select>
