<label for="name" class="form-label">Имя</label>
<input type="text"
       name="name"
       value="{{ old('name', $name) }}"
       id="name"
       class="form-control"
       required>
