<form onsubmit="return confirmBeforeRemove()"
      action="{{ route($routeName, $id) }}"
      method="POST"
      class="me-1">
    @method('DELETE')
    @csrf
    <button type="submit"
            class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i>Удалить</button>
</form>
