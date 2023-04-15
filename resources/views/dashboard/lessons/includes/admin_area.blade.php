@if(Auth::user()->isAdmin())
    <div id="admin-area">
        <p>Администрирование</p>
        @include('dashboard.lessons.includes.accordion_colors', ['colorId' => $colorId])
        <div class="row mb-3">
            <div class="col">
                @include('dashboard.lessons.includes.fields.link_type', ['linkType' => $linkType])
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                @include('dashboard.lessons.includes.fields.link', ['link' => $link])
            </div>
        </div>
        <div class="row">
            <div class="col">
                @include('dashboard.lessons.includes.fields.email_applicant')
                @include('dashboard.lessons.includes.fields.email_teacher')
            </div>
        </div>
    </div>
@endif
