@php /** @var \App\Models\Schedule\Reason $reason */ @endphp

<form method="POST" action="{{ route($routeNames->store) }}">
    @csrf
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.reasons.includes.fields.shortname', ['shortname' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.reasons.includes.fields.name', ['name' => null])
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-4">
            @include('dashboard.reasons.includes.fields.type', ['type' => $reason->getDefaultType()])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
