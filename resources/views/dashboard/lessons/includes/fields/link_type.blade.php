@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<p class="mb-2">Тип ссылки</p>
<div class="btn-group"
     role="group"
     aria-label="toggle button group"
     style="width: 100%;">
@foreach($lesson->getLinkTypes() as $key => $linkTypeName)
    <input type="radio"
           name="link_type"
           value="{{ $key }}"
           id="link-type{{ $key }}"
           class="btn-check"
           autocomplete="off"
           @if(old('link_type', $linkType) == $key) checked @endif>
    <label class="btn btn-outline-dark"
           for="link-type{{ $key }}">{{ $linkTypeName }}</label>
@endforeach
</div>
