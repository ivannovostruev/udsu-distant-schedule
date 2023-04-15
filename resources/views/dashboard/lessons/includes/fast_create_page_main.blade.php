@php /** @var \App\Support\Pages\LessonPage $page */ @endphp

<main>
    <div class="container-fluid">
        @include('dashboard.includes.result_messages')
        <div class="row">
            <div class="col">
                @include($page->getFastCreateFormView())
            </div>
        </div>
    </div>
</main>
