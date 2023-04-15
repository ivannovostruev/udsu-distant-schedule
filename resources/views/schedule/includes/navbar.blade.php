<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        @include('schedule.includes.logo_link')
        @include('schedule.includes.navbar_toggler_button')
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-5 d-flex align-items-center">
                <li>@include('schedule.includes.today_button')</li>
                <li>@include('schedule.includes.colors_legend_button')</li>
            </ul>
            <div class="navbar-nav me-5">
                @include('schedule.includes.room_helper')
            </div>
            <div class="navbar-nav me-auto">
                @include('schedule.includes.previous_day_button')
                @include('schedule.includes.date_picker_form')
                @include('schedule.includes.next_day_button')
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                @include('includes.authentication_links')
            </ul>
        </div>
    </div>
</nav>
