<label for="date" class="form-label">Дата проведения(начала)*</label>
<div class="input-group">
    <div class="input-group-text border-dark">
        <input name="choose_date"
               type="radio"
               value="solo"
               id="enable-date"
               class="form-check-input mt-0"
               aria-label=""
               checked>
    </div>
    <input name="date"
           type="date"
           value="{{ old('date', $date) }}"
           id="date"
           class="form-control"
           aria-label="">
</div>
