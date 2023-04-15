<nav class="navbar navbar-expand-md navbar-light">
    <div class="container-fluid">
        @include('dashboard.includes.navbar_toggler_button')
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <!-- Left Side Of Navbar -->
            <div class="navbar-nav m-auto">
                @include('dashboard.includes.create_lesson_button')
            </div>
            <!-- Right Side Of Navbar -->
            @include('dashboard.includes.create_entities_button')
            @include('dashboard.includes.notifications_button')
            <ul class="navbar-nav">
                @include('includes.authentication_links')
            </ul>
        </div>
    </div>
</nav>
