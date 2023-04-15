@php /** @var \App\Utilities\LessonStatusRadioButtons $lessonStatusRadioButtons */ @endphp

<p class="mb-2">Статус</p>
<div class="btn-group"
     role="group"
     aria-label="Basic radio toggle button group"
     style="width: 100%;">
    @foreach($lessonStatusRadioButtons->get() as $button)
        @php /** @var \App\Utilities\LessonStatusRadioButton $button */ @endphp
        <input name="status"
               type="radio"
               value="{{ $button->getCode() }}"
               class="btn-check"
               id="status{{ $button->getCode() }}"
               @if(old('status', $status) == $button->getCode()) checked @endif
               autocomplete="off">
        <label class="btn {{ $button->getClass() }}"
               for="status{{ $button->getCode() }}"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               data-bs-custom-class="lesson-status-tooltip"
               data-bs-title="{{ $button->getName() }}">{{ $button->getShortname() }}</label>
    @endforeach
</div>
