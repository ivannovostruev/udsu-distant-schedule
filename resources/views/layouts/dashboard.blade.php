@php /** @var \App\Support\Pages\Page $page */ @endphp
@php /** @var \App\Models\Dashboard\Dashboard $dashboard */ @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Панель управления</title>

    @include('dashboard.includes.fonts')
    @include('dashboard.includes.css')
</head>
<body>
    <div id="dashboard">
        <div class="row g-0">
            <div class="col-sm-5 col-md-3 col-lg-3 col-xl-3 col-xxl-2">
                @include('dashboard.includes.sidebar', ['sidebar' => $dashboard->sidebar()])
            </div>
            <div class="col-sm-7 col-md-9 col-lg-9 col-xl-9 col-xxl-10">
                @include('dashboard.includes.navbar')
                @yield('content')
            </div>
        </div>{{-- /.row --}}
    </div>
    @include('dashboard.includes.scripts')
</body>
</html>
