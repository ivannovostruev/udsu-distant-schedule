<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">{!! $sortLink->get('#', [0, 1]) !!}</th>
            <th>{!! $sortLink->get('Название', [2, 3]) !!}</th>
            <th style="width: 10%; min-width: 280px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $group)
        @php /** @var \App\Models\Schedule\Group $group */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $group->id }}</td>
            <td class="align-middle">
                <a href="{{ route($routeNames->show, $group->id) }}">{{ $group->name }}</a>
            </td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $group->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
