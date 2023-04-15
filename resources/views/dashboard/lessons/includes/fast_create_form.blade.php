@php /** @var \App\Support\Abilities\LessonAbilities $abilities */ @endphp
@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<form method="POST" action="{{ route($routeNames->store) }}" class="mb-3">
    @csrf
    @include('dashboard.lessons.includes.fields.multi_date_mode')
    <div class="row">
        <div class="col-8">
            <div class="row mb-3">
                <div class="col">
                    @include('dashboard.lessons.includes.fields.name', ['name' => null])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.date_with_check', ['date' => $date])
                </div>
                @if(Auth::user()->isAdmin())
                    <div class="col-auto">
                        @include('dashboard.lessons.includes.fields.periodicity', ['periodicity' => null])
                    </div>
                    <div class="col-auto">
                        @include('dashboard.lessons.includes.fields.expiration_date', ['expirationDate' => null])
                    </div>
                @endif
            </div>
            <div class="row mb-3">
                <div class="col">
                    @include('dashboard.lessons.includes.fields.dates', ['dates' => null])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.fast_timeslots')
                </div>
                @can($abilities->showAdminOption())
                    <div class="col-auto">
                        @include('dashboard.lessons.includes.fields.room_id', ['roomId' => $roomId])
                    </div>
                @endcan
            </div>
            <div class="row mb-3">
                <div class="col">
                    @include('dashboard.lessons.includes.fields.teacher_id', ['teacherId' => null])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.education_level', ['educationLevel' => null])
                </div>
                <div class="col groups-select2">
                    @include('dashboard.lessons.includes.fields.groups')
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.system_type', ['systemType' => $lesson->getDefaultSystemType()])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.location', ['location' => $lesson->getDefaultLocation()])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.type', ['type' => $lesson->getDefaultType()])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.special_requirements', ['specialRequirements' => []])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.should_record', ['shouldRecord' => $lesson->should_record])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    @include('dashboard.lessons.includes.fields.commentary', ['commentary' => null])
                </div>
            </div>
        </div>
        @can($abilities->showAdminOption())
            <div class="col-4 mt-4">
                @include('dashboard.lessons.includes.manager_area', [
                    'status'        => $statusCode,
                    'adminFeedback' => null,
                ])
                @include('dashboard.lessons.includes.admin_area', [
                    'colorId'   => null,
                    'linkType'  => $lesson->getDefaultLinkType(),
                    'link'      => null,
                ])
                @include('dashboard.includes.grid_layout')
            </div>
        @endcan
    </div>
    <div class="row">
        <div class="col">
            @include('dashboard.lessons.includes.form_buttons')
        </div>
    </div>
</form>
