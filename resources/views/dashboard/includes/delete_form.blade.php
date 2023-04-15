<form method="POST"
      action="{{ route($routeName, $id) }}"
      onsubmit="return confirmBeforeRemove()"
      class="me-1">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Удалить</button>
</form>
