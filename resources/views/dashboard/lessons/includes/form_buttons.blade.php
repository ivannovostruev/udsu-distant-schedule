<div class="btnformgroup">
    @include('dashboard.lessons.includes.save_button')
    @if($user->isCreator())
        @include('dashboard.lessons.includes.save_as_draft_button')
    @endif
    @include('dashboard.includes.cancel_button', ['routeName' => $routeNames->index])
</div>
