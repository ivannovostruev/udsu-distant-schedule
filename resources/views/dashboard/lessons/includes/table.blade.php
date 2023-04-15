<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- 87% -->
            <th style="width:3%;">{!! $sortLink->get('#', [0, 1]) !!}</th>
            <th style="width:12%;">{!! $sortLink->get('Название', [2, 3]) !!}</th>
            <th style="width:7%;">{!! $sortLink->get('Дата', [4, 5]) !!}</th>
            <th style="width:5%;">Таймслот</th>
            <th style="width:7%;">{!! $sortLink->get('Комната', [6, 7]) !!}</th>
            <th style="width:15%;">{!! $sortLink->get('Преподаватель', [8, 9]) !!}</th>
            <th style="width:15%;">{!! $sortLink->get('Кем создано', [10, 11]) !!}</th>
            <th style="width:7%;">Статус</th>
            <th style="width:10%; min-width:280px;"></th>
        </tr>
    </thead>
    <tbody>
    @foreach($paginator as $lesson)
        @php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp
        <tr>
            <td class="align-middle text-center">{{ $lesson->id }}</td>
            <td class="align-middle">
                <a href="{{ route($routeNames->show, $lesson->id) }}">{{ $lesson->name }}</a>
            </td>
            <td class="align-middle text-center">{{ $lesson->date }}</td>
            <td class="align-middle text-center">{{ $lesson->timeslot->name }}</td>
            <td class="align-middle text-center">
                @if($lesson->room)
                    <a href="{{ route('dashboard.rooms.show', $lesson->room->id) }}">{{ $lesson->room->name }}</a>
                @endif
            </td>
            <td class="align-middle">
                <a href="{{ route('dashboard.teachers.show', $lesson->teacher->id) }}">{{ $lesson->teacher->full_name }}</a>
            </td>
            <td class="align-middle">
                <a href="{{ route('dashboard.users.show', $lesson->creator->id) }}">{{ $lesson->creator->name }}</a>
            </td>
            <td class="align-middle text-center {{ $lesson->getStatusCssClass() }}">{{ $lesson->getStatusAsWord() }}</td>
            <td class="align-middle">@include('dashboard.lessons.includes.table_actions')</td>
        </tr>
    @endforeach
    </tbody>
</table>
