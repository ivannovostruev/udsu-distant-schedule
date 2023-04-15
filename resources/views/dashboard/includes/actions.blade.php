@php /** @var \App\Support\Pages\Page $page */ @endphp

@if($page->isUploadRequired())
    @include('dashboard.includes.upload_button', ['routeName' => $routeNames->upload])
@endif

@if($page->isFiltersRequired())
    @include('dashboard.includes.filter_button')
@endif

@include('dashboard.includes.create_button', ['routeName' => $routeNames->create])
