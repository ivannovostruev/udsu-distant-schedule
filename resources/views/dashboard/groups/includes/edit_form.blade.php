@php /** @var \App\Models\Schedule\Group $group */ @endphp

<form method="POST" action="{{ route($routeNames->update, $group->id) }}">
    @method('PATCH')
    @csrf
    <div class="row">
        <div class="col-4">
            @include('dashboard.groups.includes.fields.name', ['name' => $group->name])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
