<p class="mb-2">Нужно ли записать занятие?</p>
<input type="checkbox"
       name="should_record"
       value="1"
       class="btn-check"
       id="should-record"
       autocomplete="off"
       @if(old('should_record') == 1) checked @endif>
<label for="should-record"
       class="btn btn-outline-dark">Сделать запись занятия<i class="bi bi-record-fill"></i></label>
