<form method="GET" action="{{ route($routeNames->index) }}">
    <div id="user-name-search" class="input-group">
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Имя"
               aria-label="Имя"
               aria-describedby="button-user-search">
        <button type="submit"
                id="button-user-search"
                class="btn btn-outline-primary">Найти</button>
    </div>
</form>
