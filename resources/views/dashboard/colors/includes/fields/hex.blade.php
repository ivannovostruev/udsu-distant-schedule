<label for="hex" class="form-label">Выберите цвет</label>
<input type="color"
       value="{{ old('hex', $hex) }}"
       name="hex"
       id="hex"
       class="form-control form-control-color w-100"
       required>
