<label for="type" class="form-label">Тип занятия</label>
<select name="type"
        id="type"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($lesson->getTypes() as $key => $type)
        <option value="{{ $key }}" @if(old('type') == $key) selected @endif>{{ $type }}</option>
    @endforeach
</select>
