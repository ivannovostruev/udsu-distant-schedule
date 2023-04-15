@canany([
    \App\Support\Abilities\TeacherAbilities::CREATE,
    \App\Support\Abilities\RoomAbilities::CREATE,
    \App\Support\Abilities\TimeslotAbilities::CREATE,
    \App\Support\Abilities\GroupAbilities::CREATE,
    \App\Support\Abilities\ColorAbilities::CREATE,
    \App\Support\Abilities\UserAbilities::CREATE,
])
    <div class="btn-group" role="group">
        <button type="button"
                id="new-entity"
                class="btn me-2 rounded"
                data-bs-toggle="dropdown"
                aria-expanded="false"><i class="bi bi-grid-3x3-gap-fill"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            @can(\App\Support\Abilities\TeacherAbilities::CREATE)
                <li><a href="{{ route('dashboard.teachers.create') }}"
                       class="dropdown-item">Преподаватель</a></li>
            @endcan
            @can(\App\Support\Abilities\RoomAbilities::CREATE)
                <li><a href="{{ route('dashboard.rooms.create') }}"
                       class="dropdown-item">Комната</a></li>
            @endcan
            @can(\App\Support\Abilities\TimeslotAbilities::CREATE)
                <li><a href="{{ route('dashboard.timeslots.create') }}"
                       class="dropdown-item">Таймслот</a></li>
            @endcan
            @can( \App\Support\Abilities\GroupAbilities::CREATE)
                <li><a href="{{ route('dashboard.groups.create') }}"
                       class="dropdown-item">Академическая группа</a></li>
            @endcan
            @can(\App\Support\Abilities\ColorAbilities::CREATE)
                <li><a href="{{ route('dashboard.colors.create') }}"
                       class="dropdown-item">Цвет ячейки</a></li>
            @endcan
            @can(\App\Support\Abilities\UserAbilities::CREATE)
                <li><a href="{{ route('dashboard.users.create') }}"
                       class="dropdown-item">Пользователь</a></li>
            @endcan
        </ul>
    </div>
@endcanany
