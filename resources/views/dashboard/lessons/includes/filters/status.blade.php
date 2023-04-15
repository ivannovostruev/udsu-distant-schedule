<label for="status" class="form-label">Статус</label>
<select name="status"
        id="status"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($lesson->getStatuses() as $key => $status)
        <option value="{{ $key }}" @if(old('status') == $key) selected @endif>{{ $status }}</option>
    @endforeach
</select>
