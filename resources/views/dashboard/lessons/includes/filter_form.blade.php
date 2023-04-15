<form method="GET" action="{{ route($routeNames->index) }}">
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.name')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.status')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.room_id')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.location')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.type')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.education_level')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.date')
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.system_type')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.link_type')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.special_requirements')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.should_record')
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.teacher_id')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.created_by')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.timeslots')
                </div>
                <div class="col-auto">
                    @include('dashboard.lessons.includes.filters.groups')
                </div>
            </div>
            @include('dashboard.lessons.includes.filters.color_id')
        </div>
    </div>
    <div>
        @include('dashboard.includes.filter_apply_button')
        @include('dashboard.includes.filter_reset_button', ['routeName' => $routeNames->index])
    </div>
</form>
