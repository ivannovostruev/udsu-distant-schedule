<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row mb-3">
        <div class="col-auto">
            @include('dashboard.colors.includes.fields.hex', ['hex' => '#ffd700'])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.colors.includes.fields.description', ['description' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
