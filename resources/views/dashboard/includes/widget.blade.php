@php /** @var \App\Models\DashboardWidget $widget */ @endphp

<div class="col-3 mb-4">
    <a href="{{ route($widget->getRoute()) }}">
        <div class="card {{ $widget->getCssClass() }}">
            <div class="card-body d-flex justify-content-between pb-5">
                <div class="card-title">{{ $widget->getTitle() }}</div>
                <div class="count">{{ $widget->getCount() }}</div>
            </div>
        </div>
    </a>
</div>
