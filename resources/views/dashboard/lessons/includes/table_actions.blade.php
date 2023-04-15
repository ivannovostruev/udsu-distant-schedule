@php /** @var \App\Support\Abilities\Abilities $abilities */ @endphp
@php /** @var \App\Models\Schedule\Lesson $lesson */ @endphp

<div class="actions d-flex justify-content-center">
    @can($abilities->edit(), $lesson)
        @include('dashboard.includes.edit_button', ['routeName' => $routeNames->edit, 'id' => $lesson->id])
    @endcan
    @can($abilities->destroy())
        @include('dashboard.includes.delete_form', ['routeName' => $routeNames->destroy, 'id' => $lesson->id])
    @endcan
</div>
