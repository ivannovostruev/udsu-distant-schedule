@php /** @var \App\Support\Pages\Page $page */ @endphp

<div class="actions d-flex justify-content-center">
    @include('dashboard.includes.ui.edit_button', ['routeName' => $routeNames->edit, 'id' => $id])
    @if($page->isDestroyRequired())
        @include('dashboard.includes.ui.delete_form', ['routeName' => $routeNames->destroy, 'id' => $id])
    @endif
</div>
