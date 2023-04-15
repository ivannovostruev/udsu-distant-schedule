<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.rooms.includes.fields.name', ['name' => null])
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            @include('dashboard.rooms.includes.fields.link', ['link' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
