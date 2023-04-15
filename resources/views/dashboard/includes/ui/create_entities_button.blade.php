@canany([
    'dashboard-teacher-create',
    'dashboard-room-create',
    'dashboard-timeslot-create',
    'dashboard-group-create',
    'dashboard-color-create',
])
    <div class="btn-group" role="group">
        <button type="button"
                id="new-entity"
                class="btn me-2 rounded"
                data-bs-toggle="dropdown"
                aria-expanded="false"><i class="bi bi-grid-3x3-gap-fill"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            @can('dashboard-teacher-create')
                <li><a href="{{ route('teachers.create') }}"
                       class="dropdown-item">Преподаватель</a></li>
            @endcan
            @can('dashboard-room-create')
                <li><a href="{{ route('rooms.create') }}"
                       class="dropdown-item">Комната</a></li>
            @endcan
            @can('dashboard-timeslot-create')
                <li><a href="{{ route('timeslots.create') }}"
                       class="dropdown-item">Таймслот</a></li>
            @endcan
            @can('dashboard-group-create')
                <li><a href="{{ route('groups.create') }}"
                       class="dropdown-item">Академическая группа</a></li>
            @endcan
            @can('dashboard-color-create')
                <li><a href="{{ route('colors.create') }}"
                       class="dropdown-item">Цвет ячейки</a></li>
            @endcan
            @can('dashboard-user-create')
                <li><a href="{{ route('users.create') }}"
                       class="dropdown-item">Пользователь</a></li>
            @endcan
        </ul>
    </div>
@endcanany
