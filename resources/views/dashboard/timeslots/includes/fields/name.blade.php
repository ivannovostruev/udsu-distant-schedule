<label for="name" class="form-label">Название</label>
<input type="text"
       name="name"
       value="{{ old('name', $name) }}"
       id="name"
       class="form-control"
       required>
