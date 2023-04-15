@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<p class="mb-2">Таймслот*</p>
<div class="d-flex">
@foreach($timeslots as $timeslot)
    <div class="me-2">
        @php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp
        <input type="radio"
               value="{{ $timeslot->id }}"
               name="timeslot_id"
               id="timeslot{{ $timeslot->id }}"
               class="btn-check"
               autocomplete="off"
               @if(old('timeslot_id', $timeslotId) == $timeslot->id) checked @endif>
        <label class="btn btn-outline-dark"
               for="timeslot{{ $timeslot->id }}"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               data-bs-custom-class="timeslot-tooltip"
               data-bs-title="{{ $timeslot->getInterval() }}">{{ $timeslot->name }}</label>
    </div>
@endforeach
</div>
