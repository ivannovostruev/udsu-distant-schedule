<label for="room-id" class="form-label">Комната</label>
<select name="room_id"
        id="room-id"
        class="form-select">
    <option value="" disabled selected>не выбрано</option>
    @foreach($rooms as $room)
        @php /** @var \App\Models\Schedule\Room $room */ @endphp
        <option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif>{{ $room->name }}</option>
    @endforeach
</select>
