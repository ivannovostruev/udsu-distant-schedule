@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Schedule\Room $room */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-5">
            <div class="col-auto">
                <h3 class="mb-3">{{ $page->getShowPageTitle() }} <span>{{ $room->name }}</span></h3>
            </div>
            <div class="col-auto">
                @include('dashboard.includes.show_page_actions', ['id' => $room->id])
            </div>
        </div>
    </div>
</header>
