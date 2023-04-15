<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.name', ['name' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.username', ['username' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.email', ['email' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.password')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.role_id', ['roleId' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
