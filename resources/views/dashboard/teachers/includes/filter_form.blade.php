<form method="GET"
      action="{{ route($routeNames->index) }}">
    <div class="row mb-3">
        <div class="col-auto">
            @include('dashboard.teachers.includes.filters.full_name')
        </div>
        <div class="col-auto">
            @include('dashboard.teachers.includes.filters.email')
        </div>
    </div>
    <div>
        @include('dashboard.includes.filter_apply_button')
        @include('dashboard.includes.filter_reset_button', ['routeName' => $routeNames->index])
    </div>
</form>
