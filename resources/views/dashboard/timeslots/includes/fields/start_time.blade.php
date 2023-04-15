<label for="start-time" class="form-label">Время начала</label>
<input type="time"
       name="start_time"
       value="{{ old('start_time', $startTime) }}"
       id="start-time"
       class="form-control"
       required>
