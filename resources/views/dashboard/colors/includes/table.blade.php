<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">#</th>
            <th style="width:10%">hex</th>
            <th>Описание</th>
            <th style="width: 10%; min-width: 280px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $color)
        @php /** @var \App\Models\Schedule\Color $color */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $color->id }}</td>
            <td class="align-middle text-center" style="background-color:{{ $color->hex }};">
                <a href="{{ route($routeNames->show, $color->id) }}"
                   class="{{ $color->getTextColorCssClass()}}">{{ $color->hex }}</a>
            </td>
            <td>{{ $color->description }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $color->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
