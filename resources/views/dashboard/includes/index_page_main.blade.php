@php /** @var \App\Support\Pages\Page $page */ @endphp

<main>
    <div class="container-fluid">
        @if($page->isFiltersRequired())
            <div class="row">
                @include($page->getFiltersView())
            </div>
        @endif
        @include('dashboard.includes.result_messages')
        @if($paginator->total())
            <div class="row">
                <div class="col">
                    @include($page->getIndexTableView())
                </div>
            </div>
            <div class="row justify-content-end g-0">
                @if($page->isPerPageRequired())
                    <div class="col-auto me-3">
                        @include('dashboard.includes.per_page_form', ['routeName' => $routeNames->index])
                    </div>
                @endif
                <div class="col-auto">
                    {{ $paginator->links() }}
                </div>
            </div>
        @else
            <p class="text-center fs-4">Записи не найдены</p>
        @endif
    </div>
</main>
