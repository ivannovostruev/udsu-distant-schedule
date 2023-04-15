@php /** @var \App\Models\Schedule\Room $room */ @endphp

<form method="POST" action="{{ route($routeNames->update, $room->id) }}">
    @method('PATCH')
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.rooms.includes.fields.name', ['name' => $room->name])
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            @include('dashboard.rooms.includes.fields.link', ['link' => $room->link])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
