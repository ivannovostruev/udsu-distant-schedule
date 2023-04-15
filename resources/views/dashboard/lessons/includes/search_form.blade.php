<form method="GET" action="{{ route($routeNames->index) }}">
    <div id="lesson-name-search" class="input-group">
        <input type="text"
               name="name"
               class="form-control"
               placeholder="Название"
               aria-label="Название"
               aria-describedby="button-lesson-search">
        <button type="submit"
                id="button-lesson-search"
                class="btn btn-outline-primary">Найти</button>
    </div>
</form>
