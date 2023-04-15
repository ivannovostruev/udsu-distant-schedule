@php /** @var \App\Support\Pages\Page $page */ @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Расписание</title>

    @include('schedule.includes.fonts')
    @include('schedule.includes.css')
</head>
<body>
    <div id="schedule">
        @include('schedule.includes.navbar')
        <main>
            @yield('content')
        </main>
    </div>
    @include('schedule.includes.colors_legend_modal')
    @include('schedule.includes.scripts')
</body>
</html>
