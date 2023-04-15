<label for="name" class="form-label">Название*</label>
<input type="text"
       name="name"
       value="{{ old('name', $name) }}"
       id="name"
       class="form-control"
       minlength="3"
       required>
<div id="name-help" class="form-text">Максимум 256 символов</div>
