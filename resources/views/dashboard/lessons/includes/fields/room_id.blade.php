@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<label for="room-id" class="form-label">Комната</label>
<select name="room_id"
        id="room-id"
        class="form-select">
@if(is_null($roomId))
    <option disabled selected>не выбрано</option>
    @foreach($rooms as $room)
        @php /** @var \App\Models\Schedule\Room $room */ @endphp
        <option value="{{ $room->id }}">{{ $room->name }}</option>
    @endforeach
@else
    @foreach($rooms as $room)
        @php /** @var \App\Models\Schedule\Room $room */ @endphp
        <option value="{{ $room->id }}"
                @if(old('room_id', $roomId) == $room->id) selected @endif>{{ $room->name }}
        </option>
    @endforeach
@endif
</select>
