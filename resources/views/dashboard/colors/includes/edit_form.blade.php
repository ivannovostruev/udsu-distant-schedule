@php /** @var \App\Models\Schedule\Color $color */ @endphp

<form method="POST" action="{{ route($routeNames->update, $color->id) }}">
    @method('PATCH')
    @csrf
    <div class="row mb-3">
        <div class="col-auto">
            @include('dashboard.colors.includes.fields.hex', ['hex' => $color->hex])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.colors.includes.fields.description', ['description' => $color->description])
        </div>
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.includes.form_buttons')
        </div>
    </div>
</form>
