@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<p class="mb-2">Таймслоты*</p>
<div class="d-flex">
    @foreach($timeslots as $timeslot)
        <div class="me-2">
            @php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp
            <input name="timeslots[]"
                   type="checkbox"
                   value="{{ $timeslot->id }}"
                   id="timeslot{{ $timeslot->id }}"
                   class="btn-check"
                   @if(in_array($timeslot->id, old('timeslots', []))) checked @endif>
            <label class="btn btn-outline-dark"
                   for="timeslot{{ $timeslot->id }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="top"
                   data-bs-custom-class="timeslot-tooltip"
                   data-bs-title="{{ $timeslot->getInterval() }}">{{ $timeslot->name }}</label>
        </div>
    @endforeach
</div>
<div id="timeslots-help" class="form-text">Выберите один или несколько таймслотов</div>
