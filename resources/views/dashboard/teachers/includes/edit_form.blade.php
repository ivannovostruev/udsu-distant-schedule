@php /** @var \App\Models\Schedule\Teacher $teacher */ @endphp

<form method="POST" action="{{ route($routeNames->update, $teacher->id) }}">
    @method('PATCH')
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.full_name', ['fullName' => $teacher->full_name])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.email', ['email' => $teacher->email])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.teachers.includes.fields.description', ['description' => $teacher->description])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
