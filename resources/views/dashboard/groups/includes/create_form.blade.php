<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row">
        <div class="col-4">
            @include('dashboard.groups.includes.fields.name', ['name' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
