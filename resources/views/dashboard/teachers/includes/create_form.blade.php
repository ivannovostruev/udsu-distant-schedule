<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.full_name', ['fullName' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.email', ['email' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.description', ['description' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
