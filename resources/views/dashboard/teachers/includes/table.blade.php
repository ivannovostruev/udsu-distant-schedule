<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>{!! $sortLink->get('#', [0, 1]) !!}</th>
            <th style="width:20%">{!! $sortLink->get('ФИО', [2, 3]) !!}</th>
            <th style="width:20%">{!! $sortLink->get('Email', [4, 5]) !!}</th>
            <th>Описание</th>
            <th style="width: 10%; min-width: 300px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $teacher)
        @php /** @var \App\Models\Schedule\Teacher $teacher */ @endphp
        <tr>
            <td class="align-middle text-center">
                {{ $teacher->id }}
            </td>
            <td class="align-middle">
                <a href="{{ route('dashboard.teachers.show', $teacher->id) }}">
                    {{ $teacher->full_name }}
                </a>
            </td>
            <td class="align-middle">{{ $teacher->email }}</td>
            <td class="align-middle">{{ $teacher->description }}</td>
            <td class="align-middle">@include('dashboard.includes.table_actions', ['id' => $teacher->id])</td>
        </tr>
    @endforeach
    </tbody>
</table>
