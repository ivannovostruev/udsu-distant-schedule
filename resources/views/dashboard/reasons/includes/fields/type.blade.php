@php /** @var \App\Models\Schedule\Reason $reason */ @endphp

<p class="mb-2">Тип</p>
<div class="btn-group" role="group" aria-label="toggle button group">
    @foreach($reason->getTypes() as $key => $typeName)
        <input type="radio"
               name="type"
               value="{{ $key }}"
               id="type{{ $key }}"
               class="btn-check"
               autocomplete="off"
               @if(old('type', $type) == $key) checked @endif>
        <label class="btn btn-outline-dark" for="type{{ $key }}">{{ $typeName }}</label>
    @endforeach
</div>
