@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Schedule\Group $group */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-5">
            <div class="col-auto">
                <h3>{{ $page->getShowPageTitle() }} {{ $group->name }}</h3>
            </div>
            <div class="col-auto">
                @include('dashboard.includes.show_page_actions', ['id' => $group->id])
            </div>
        </div>
    </div>
</header>
