<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row align-items-end">
        <div class="col-3">
            @include('dashboard.timeslots.includes.fields.name', ['name' => null])
        </div>
        <div class="col-auto">
            @include('dashboard.timeslots.includes.fields.start_time', ['startTime' => null])
        </div>
        <div class="col-auto">
            @include('dashboard.timeslots.includes.fields.end_time', ['endTime' => null])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
