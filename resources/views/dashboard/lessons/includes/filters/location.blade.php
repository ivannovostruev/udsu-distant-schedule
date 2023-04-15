<label for="location" class="form-label">Место проведения</label>
<select name="location"
        id="location"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($lesson->getLocations() as $key => $location)
        <option value="{{ $key }}" @if(old('location') == $key) selected @endif>{{ $location }}</option>
    @endforeach
</select>
