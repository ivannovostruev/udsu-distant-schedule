@php /** @var \App\Support\Pages\Page $page */ @endphp

<main>
    <div class="container-fluid">
        @include('dashboard.includes.result_messages')
        <div class="row">
            <div class="col">
                @include($page->getEditFormView())
            </div>
        </div>
    </div>
</main>
