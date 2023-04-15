<label for="name" class="form-label">Название*</label>
<textarea name="name"
          id="name"
          rows="4"
          class="form-control"
          required>{{ old('name', $name) }}</textarea>
