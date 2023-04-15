<label for="end-time" class="form-label">Время конца</label>
<input type="time"
       name="end_time"
       value="{{ old('end_time', $endTime) }}"
       id="end-time"
       class="form-control"
       required>
