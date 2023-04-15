@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Schedule\Color $color */ @endphp

<header>
    <div class="container-fluid">
        <div class="row justify-content-between mb-5">
            <div class="col-auto">
                <h3>{{ $page->getShowPageTitle() }}
                    <span class="{{ $color->getTextColorCssClass() }} rounded p-2"
                          style="background-color:{{ $color->hex }};">{{ $color->hex }}</span>
                </h3>
            </div>
            <div class="col-auto">
                @include('dashboard.includes.show_page_actions', ['id' => $color->id])
            </div>
        </div>
    </div>
</header>
