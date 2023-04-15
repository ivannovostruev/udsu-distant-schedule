<form method="GET" action="{{ route($routeNames->index) }}">
    <div id="teacher-name-search" class="input-group">
        <input type="text"
               name="full_name"
               class="form-control"
               placeholder="ФИО"
               aria-label="ФИО"
               aria-describedby="button-teacher-search">
        <button type="submit"
                id="button-teacher-search"
                class="btn btn-outline-primary">Найти</button>
    </div>
</form>
