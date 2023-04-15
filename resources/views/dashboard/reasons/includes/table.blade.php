<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">{!! $sortLink->get('#', [0, 1]) !!}</th>
            <th>{!! $sortLink->get('Шифр', [2, 3]) !!}</th>
            <th>{!! $sortLink->get('Название', [4, 5]) !!}</th>
            <th>{!! $sortLink->get('Тип', [6, 7]) !!}</th>
            <th style="width: 10%; min-width: 170px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $reason)
        @php /** @var \App\Models\Schedule\Reason $reason */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $reason->id }}</td>
            <td class="align-middle text-center">
                <a href="{{ route($routeNames->show, $reason->id) }}">{{ $reason->shortname }}</a>
            </td>
            <td class="align-middle">
                <a href="{{ route($routeNames->show, $reason->id) }}">{{ $reason->name }}</a>
            </td>
            <td class="align-middle text-center">{{ $reason->getTypeName() }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $reason->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
