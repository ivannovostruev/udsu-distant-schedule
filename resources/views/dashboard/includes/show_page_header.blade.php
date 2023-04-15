@php /** @var \App\Support\Pages\Page $page */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-5">
            <div class="col-auto">
                <h3>{{ $page->getShowPageTitle() }}</h3>
            </div>
        </div>
    </div>
</header>
