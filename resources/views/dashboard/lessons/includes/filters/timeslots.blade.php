<label for="timeslots" class="form-label">Таймслоты</label>
<select name="timeslots[]"
        id="timeslots"
        class="form-select"
        size="3"
        multiple>
    @foreach($timeslots as $timeslot)
        @php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp
        @if(old('timeslots'))
            <option value="{{ $timeslot->id }}"
                    @if(in_array($timeslot->id, old('timeslots'))) selected @endif>
                {{ $timeslot->name }}
                ({{ $timeslot->getStartTimeWithoutSeconds() }} -
                {{ $timeslot->getEndTimeWithoutSeconds() }})
            </option>
        @else
            <option value="{{ $timeslot->id }}">
                {{ $timeslot->name }}
                ({{ $timeslot->getStartTimeWithoutSeconds() }} -
                {{ $timeslot->getEndTimeWithoutSeconds() }})
            </option>
        @endif
    @endforeach
</select>
