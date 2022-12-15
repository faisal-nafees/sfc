<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img class="img-fluid nav-logo" src="/img/Safety%20First%20Logo%20Invert.png">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item {{ Request::path() === '/' ? 'active' : '' }}">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ Request::path() === 'About' ? 'active' : '' }}">
        <a class="nav-link" href="About">About</a>
      </li>
      <li
        class="nav-item dropdown {{ Request::path() === 'OSHA-Training' ? 'active' : '' }} {{ Request::path() === 'New-Miner-Rraining' ? 'active' : '' }} {{ Request::path() === 'Experienced-Miner-Training' ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          Training
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Miner-New-Experienced-Annual">Miner (New, Experienced,
            Annual)</a>
          <a class="dropdown-item" href="Other-Training">Other Training</a>
        </div>
      </li>
      <li class="nav-item {{ Request::path() === 'Contact' ? 'active' : '' }}">
        <a class="nav-link" href="Contact" tabindex="-1" aria-disabled="true">Contact</a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn nav-btn my-2 my-sm-0" type="submit">Search</button>
            </form> -->
    <div class="my-2 my-lg-2">
      <a href="/login" class="btn nav-btn my-2 my-sm-0 ml-3">login</a>
    </div>
  </div>
</nav>
