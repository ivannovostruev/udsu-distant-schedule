@php /** @var \App\Support\Abilities\LessonAbilities $abilities */ @endphp
@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-5">
            <div class="col-auto">
                <h3 class="mb-3">{{ $page->getShowPageTitle() }} <span>{{ $lesson->name }}</span>
                    <span class="badge {{ $lesson->getStatusCssClass() }}">{{ $lesson->getStatusAsWord() }}</span>
                    @if($lesson->should_record)
                        <span class="badge bg-danger">с записью</span>
                    @endif
                </h3>
            </div>
            <div class="col-auto actions">
                @include('dashboard.lessons.includes.lesson_id_button', ['lessonId' => $lesson->id])
                @can($abilities->edit(), $lesson)
                    @include('dashboard.includes.edit_button_outline', ['routeName' => $routeNames->edit, 'id' => $lesson->id])
                @endcan
                @can($abilities->destroy())
                    @include('dashboard.includes.delete_form_outline', ['routeName' => $routeNames->destroy, 'id' => $lesson->id])
                @endcan
            </div>
        </div>
    </div>
</header>
