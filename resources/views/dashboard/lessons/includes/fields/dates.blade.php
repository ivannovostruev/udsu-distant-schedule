<label for="dates" class="form-label">Даты проведения</label>
<div class="input-group">
    <div class="input-group-text border-dark">
        <input name="choose_date"
               type="radio"
               value="many"
               id="enable-dates"
               class="form-check-input mt-0"
               aria-label="">
    </div>
    <input name="dates"
           type="text"
           value="{{ old('dates', $dates) }}"
           id="dates"
           class="form-control"
           minlength="8"
           placeholder="Пример: 30.08.2022, 31.08.2022, 01.09.2022"
           aria-label=""
           disabled>
</div>
<div id="dates-help"
     class="form-text">Вы можете создать сразу несколько занятий, перечислив даты их проведения в формате ДД.ММ.ГГГГ через запятую</div>
