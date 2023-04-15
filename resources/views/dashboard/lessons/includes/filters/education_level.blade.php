<label for="education-level" class="form-label">Уровень образования</label>
<select name="education_level"
        id="education-level"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($lesson->getEducationLevels() as $key => $educationLevel)
        <option value="{{ $key }}" @if(old('education_level') == $key) selected @endif>{{ $educationLevel }}</option>
    @endforeach
</select>
