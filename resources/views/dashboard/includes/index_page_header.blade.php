@php /** @var \App\Support\Pages\Page $page */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-3">
            <div class="col-auto">
                <h3>{{ $page->getIndexPageTitle() }}
                    @include('dashboard.includes.counter', ['count' => $paginator->total()])
                </h3>
            </div>
            @if($page->isSearchRequired())
                <div class="col-auto text-center">
                    @include($page->getSearchFormView())
                </div>
            @endif
            <div class="col-auto text-end">
                @include('dashboard.includes.actions')
            </div>
        </div>
    </div>
</header>
