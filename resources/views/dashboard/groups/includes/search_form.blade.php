<form method="GET" action="{{ route($routeNames->index) }}">
    <div id="group-name-search" class="input-group">
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Название"
               aria-label="Название"
               aria-describedby="button-group-search">
        <button type="submit"
                id="button-group-search"
                class="btn btn-outline-primary">Найти</button>
    </div>
</form>
