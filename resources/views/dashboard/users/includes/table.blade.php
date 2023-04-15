<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width:3%;">{!! $sortLink->get('#', [0, 1]) !!}</th>
            <th>{!! $sortLink->get('Имя', [2, 3]) !!}</th>
            <th>{!! $sortLink->get('Email', [4, 5]) !!}</th>
            <th style="width:300px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $user)
        @php /** @var \App\Models\User $user */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $user->id }}</td>
            <td class="align-middle">
                <a href="{{ route($routeNames->show, $user->id) }}">{{ $user->name }}</a>
            </td>
            <td class="align-middle">{{ $user->email }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $user->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
