<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">#</th>
            <th>Название</th>
            <th>Ссылка</th>
            <th style="width: 10%; min-width: 280px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $room)
        @php /** @var \App\Models\Schedule\Room $room */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $room->id }}</td>
            <td class="align-middle">
                <a href="{{ route($routeNames->show, $room->id) }}">{{ $room->name }}</a>
            </td>
            <td class="align-middle">{{ $room->link }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $room->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
