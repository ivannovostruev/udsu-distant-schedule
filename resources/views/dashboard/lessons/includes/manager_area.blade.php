<div id="manager-area" class="mb-3">
    <p>Управление</p>
    <div class="row mb-3">
        <div class="col">
            @include('dashboard.lessons.includes.fields.status_new', ['status' => $status])
        </div>
    </div>
    @include('dashboard.lessons.includes.accordion_status_approved_reasons')
    @if(!empty($editable))
        @include('dashboard.lessons.includes.accordion_status_rejected_reasons')
    @endif
    <div class="row">
        <div class="col">
            @include('dashboard.lessons.includes.fields.admin_feedback', ['adminFeedback' => $adminFeedback])
        </div>
    </div>
</div>
