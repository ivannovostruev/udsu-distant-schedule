@php /** @var \App\Support\Abilities\LessonAbilities $abilities */ @endphp
@php /** @var \App\Support\Abilities\RoomAbilities $roomAbilities */ @endphp
@php /** @var \App\Support\Abilities\TeacherAbilities $teacherAbilities */ @endphp
@php /** @var \App\Support\Abilities\UserAbilities $userAbilities */ @endphp
@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<main>
    <div class="container-fluid">
        <dl class="row">
            <dt class="col-3">Ссылка</dt>
            <dd class="col-9"><a href="{{ ($lesson->getLinkTypeName() === 1) ? $lesson->link : $lesson->room->link }}"
                                 target="_blank">{{ ($lesson->getLinkTypeName() === 1) ? $lesson->link : $lesson->room->link }}</a></dd>
            <dt class="col-3">Комната</dt>
            <dd class="col-9">
                @if($lesson->room_id)
                    @can($roomAbilities->show())
                        <a href="{{ route('dashboard.rooms.show', $lesson->room_id) }}">{{ $lesson->room->name }}</a>
                    @else
                        {{ $lesson->room->name }}
                    @endcan
                @else
                    не выбрана
                @endif
            </dd>
            <dt class="col-3">Дата проведения</dt>
            <dd class="col-9">{{ $lesson->getDateToShow() }}</dd>
            <dt class="col-3">Таймслот</dt>
            <dd class="col-9">{{ $lesson->timeslot->name }}</dd>
            <dt class="col-3">Преподаватель</dt>
            <dd class="col-9">
                @can($teacherAbilities->show())
                    <a href="{{ route('dashboard.teachers.show', $lesson->teacher_id) }}">{{ $lesson->teacher->full_name }}</a>
                @else
                    {{ $lesson->teacher->full_name }}
                @endcan
            </dd>
            <dt class="col-3">Место проведения</dt>
            <dd class="col-9">{{ $lesson->getLocationName() }}</dd>
            <dt class="col-3">Тип ссылки</dt>
            <dd class="col-9">{{ $lesson->getLinkTypeName() }}</dd>
            <dt class="col-3">Тип системы видеоконференций</dt>
            <dd class="col-9">{{ $lesson->getSystemTypeName() }}</dd>
            <dt class="col-3">Академические группы</dt>
            <dd class="col-9">
                <ul class="list-unstyled mb-0">
                    @foreach($lesson->groups()->get() as $group)
                        @php /** @var \App\Models\Schedule\Group $group */ @endphp
                        <li>{{ $group->name }}</li>
                    @endforeach
                </ul>
            </dd>
            <dt class="col-3">Тип занятия</dt>
            <dd class="col-9">{{ $lesson->getTypeName() }}</dd>
            <dt class="col-3">Комментарий</dt>
            <dd class="col-9">{{ $lesson->commentary }}</dd>
            <dt class="col-3">Создана</dt>
            <dd class="col-9">
                @can($userAbilities->show())
                    <a href="{{ route('dashboard.users.show', $lesson->created_by) }}">{{ $lesson->creator->name }}</a>
                @else
                    {{ $lesson->creator->name }}
                @endcan
            </dd>
            <dt class="col-3">Причины</dt>
            <dd class="col-9">
                <ul class="list-unstyled mb-0">
                    @foreach($lesson->reasons()->get() as $reason)
                        @php /** @var \App\Models\Schedule\Reason $reason */ @endphp
                        <li>{{ $reason->name }}</li>
                    @endforeach
                </ul>
            </dd>
        </dl>
    </div>
</main>
