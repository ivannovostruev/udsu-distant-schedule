<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">#</th>
            <th>Название</th>
            <th>Время начала</th>
            <th>Время конца</th>
            <th style="width: 10%; min-width: 170px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $timeslot)
        @php /** @var \App\Models\Schedule\Timeslot $timeslot */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $timeslot->id }}</td>
            <td class="align-middle text-center">
                <a href="{{ route($routeNames->show, $timeslot->id) }}">{{ $timeslot->name }}</a>
            </td>
            <td class="align-middle text-center">{{ $timeslot->getStartTimeWithoutSeconds() }}</td>
            <td class="align-middle text-center">{{ $timeslot->getEndTimeWithoutSeconds() }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $timeslot->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
