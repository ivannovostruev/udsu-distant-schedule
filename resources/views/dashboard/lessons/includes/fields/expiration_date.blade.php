<label for="expiration-date" class="form-label">Дата окончания</label>
<input name="expiration_date"
       type="date"
       value="{{ old('expiration_date', $expirationDate) }}"
       id="expiration-date"
       class="form-control"
       aria-label=""
       disabled>
