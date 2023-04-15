@php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp

<form method="POST" action="{{ route($routeNames->update, $timeslot->id) }}">
    @method('PATCH')
    @csrf
    <div class="row align-items-end">
        <div class="col-3">
            @include('dashboard.timeslots.includes.fields.name', ['name' => $timeslot->name])
        </div>
        <div class="col-auto">
            @include('dashboard.timeslots.includes.fields.start_time', ['startTime' => $timeslot->start_time])
        </div>
        <div class="col-auto">
            @include('dashboard.timeslots.includes.fields.end_time', ['endTime' => $timeslot->end_time])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
