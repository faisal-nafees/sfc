<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/">Safety First Consulting <span class="invisible">Safety
            First Consulting</span> </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input id="search" class="form-control form-control-dark w-100" type="text" placeholder="Search Clients"
        aria-label="Search">

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a href="{{ route('logout') }}" class="nav-link d-none d-md-block"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</nav>
