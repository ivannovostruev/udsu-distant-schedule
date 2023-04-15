@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<p class="mb-2">Система видеоконференций*</p>
<div class="btn-group" role="group" aria-label="toggle button group">
@foreach($lesson->getSystemTypes() as $key => $systemTypeName)
    <input type="radio"
           name="system_type"
           value="{{ $key }}"
           id="system-type{{ $key }}"
           class="btn-check"
           autocomplete="off"
           @if(old('system_type', $systemType) == $key) checked @endif>
    <label class="btn btn-outline-dark"
           for="system-type{{ $key }}">{{ $systemTypeName }}</label>
@endforeach
</div>
