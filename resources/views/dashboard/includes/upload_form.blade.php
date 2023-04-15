<form method="POST"
      action="{{ route($routeName) }}"
      id="upload-file"
      enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Загрузить Excel-файл</label>
        <input type="file"
               name="file"
               id="file"
               class="form-control" required>
    </div>
    <button type="submit"
            name="submit"
            class="btn btn-primary">Загрузить файл и импортировать данные</button>
</form>
