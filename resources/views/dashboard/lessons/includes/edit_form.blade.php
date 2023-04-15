@php /** @var \App\Support\Abilities\LessonAbilities $abilities */ @endphp
@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<form method="POST"
      action="{{ route($routeNames->update, $lesson->id) }}"
      id="lesson-update">
    @method('PATCH')
    @csrf
    <div class="row">
        <div class="col-8">
            <div class="row mb-3">
                <div class="col">
                    @include('dashboard.lessons.includes.fields.name', ['name' => $lesson->name])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.date', ['date' => $lesson->date])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.timeslot_id', ['timeslotId' => $lesson->timeslot_id])
                </div>
                @can($abilities->showAdminOption())
                    <div class="col-auto">
                        @include('dashboard.lessons.includes.fields.room_id', ['roomId' => $lesson->room_id])
                    </div>
                @endcan
            </div>
            <div class="row mb-3">
                <div class="col">
                    @include('dashboard.lessons.includes.fields.teacher_id', ['teacherId' => $lesson->teacher_id])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.education_level', ['educationLevel' => $lesson->education_level])
                </div>
                <div class="col groups-select2">
                    @include('dashboard.lessons.includes.fields.groups')
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.system_type', ['systemType' => $lesson->system_type])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.location', ['location' => $lesson->location])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.type', ['type' => $lesson->type])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.special_requirements', ['specialRequirements' => $lesson->special_requirements])
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.fields.should_record', ['shouldRecord' => $lesson->should_record])
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    @include('dashboard.lessons.includes.fields.commentary', ['commentary' => $lesson->commentary])
                </div>
            </div>
        </div>
        @can($abilities->showAdminOption())
            <div class="col-4 mt-4">
                @can($abilities->approve(), $lesson)
                    @if($lesson->isRequested())
                        <div class="d-grid gap-2 mt-4">
                            @include('dashboard.lessons.includes.approve_button', ['lessonId' => $lesson->id])
                        </div>
                    @endif
                @endcan
                @include('dashboard.lessons.includes.manager_area', [
                    'status'        => $lesson->status,
                    'adminFeedback' => $lesson->admin_feedback,
                ])
                @include('dashboard.lessons.includes.admin_area', [
                    'colorId'   => $lesson->color_id,
                    'linkType'  => $lesson->link_type,
                    'link'      => $lesson->link,
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
