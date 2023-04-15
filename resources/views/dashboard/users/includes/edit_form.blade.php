@php /** @var \App\Models\User $user */ @endphp

<form method="POST" action="{{ route($routeNames->update, $user->id) }}">
    @method('PATCH')
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.name', ['name' => $user->name])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.username', ['username' => $user->username])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.email', ['email' => $user->email])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.users.includes.fields.role_id', ['roleId' => $user->role_id])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
