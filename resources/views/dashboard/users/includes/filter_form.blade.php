<form method="GET"
      action="{{ route($routeNames->index) }}">
    <div class="row mb-3">
        <div class="col-auto">
            @include('dashboard.users.includes.filters.name')
        </div>
        <div class="col-auto">
            @include('dashboard.users.includes.filters.email')
        </div>
        <div class="col-auto">
            @include('dashboard.users.includes.filters.role_id')
        </div>
    </div>
    <div>
        @include('dashboard.includes.filter_apply_button')
        @include('dashboard.includes.filter_reset_button', ['routeName' => $routeNames->index])
    </div>
</form>
