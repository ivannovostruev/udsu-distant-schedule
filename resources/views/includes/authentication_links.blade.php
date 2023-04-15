@guest
@else
    <li class="nav-item dropdown me-3">
        <a id="navbarDropdown"
           class="nav-link dropdown-toggle"
           href="#"
           role="button"
           data-bs-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
           v-pre>{{ Auth::user()->name }}</a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-right"
             aria-labelledby="navbarDropdown">
            <a class="dropdown-item"
               href="{{ route('udsu.logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form"
                  action="{{ route('udsu.logout') }}"
                  method="POST"
                  class="d-none">
                @csrf
            </form>
        </div>
    </li>
@endguest
