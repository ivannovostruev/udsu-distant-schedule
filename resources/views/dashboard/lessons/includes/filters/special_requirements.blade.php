<p class="mb-2">Что нужно для проведения занятия?</p>
<div class="btn-group" role="group" aria-label="toggle button group">
    @foreach($lesson->getSpecialRequirements() as $key => $specialRequirement)
        @if(old('special_requirements'))
            <input type="checkbox"
                   name="special_requirements[]"
                   value="{{ $key }}"
                   id="special-requirements{{ $key }}"
                   class="btn-check"
                   autocomplete="off"
                   @if(in_array($key, old('special_requirements'))) checked @endif>
        @else
            <input type="checkbox"
                   name="special_requirements[]"
                   value="{{ $key }}"
                   id="special-requirements{{ $key }}"
                   class="btn-check"
                   autocomplete="off">
        @endif
        <label class="btn btn-outline-dark" for="special-requirements{{ $key }}">{{ $specialRequirement }}</label>
    @endforeach
</div>
