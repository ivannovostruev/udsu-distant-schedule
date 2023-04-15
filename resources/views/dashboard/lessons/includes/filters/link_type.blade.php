<p class="mb-2">Тип ссылки</p>
<div class="btn-group" role="group" aria-label="toggle button group">
    @foreach($lesson->getLinkTypes() as $key => $linkType)
        <input type="radio"
               name="link_type"
               value="{{ $key }}"
               id="link-type{{ $key }}"
               class="btn-check"
               autocomplete="off"
               @if(old('link_type') == $key) checked @endif>
        <label class="btn btn-outline-dark" for="link-type{{ $key }}">{{ $linkType }}</label>
    @endforeach
</div>
