<p class="mb-2">Таймслот*</p>
@foreach($timeslots as $timeslot)
    <div class="form-check">
        @php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp
        <input name="timeslots[]"
               type="checkbox"
               value="{{ $timeslot->id }}"
               id="timeslot{{ $timeslot->id }}"
               class="form-check-input"
               @if(in_array($timeslot->id, old('timeslots', []))) checked @endif>
        <label class="form-check-label"
               for="timeslot{{ $timeslot->id }}"
               data-bs-toggle="tooltip"
               data-bs-placement="right"
               data-bs-custom-class="timeslot-tooltip"
               data-bs-title="{{ $timeslot->getInterval() }}">{{ $timeslot->name }}</label>
    </div>
@endforeach
