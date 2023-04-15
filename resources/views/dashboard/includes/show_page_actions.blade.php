@php /** @var \App\Support\Pages\Page $page */ @endphp

<div class="actions d-flex">
    @include('dashboard.includes.ui.edit_button_outline', ['routeName' => $routeNames->edit, 'id' => $id])
    @if($page->isDestroyRequired())
        @include('dashboard.includes.ui.delete_form_outline', ['routeName' => $routeNames->destroy, 'id' => $id])
    @endif
</div>
