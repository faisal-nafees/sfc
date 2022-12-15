<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="@yield('keywords')" />
  <meta name="description"
    content="At Safety First Consulting we are brokers not agents. The dictionary definition of an Training broker is a licensed representative that represents the interests of his or her clients." />
  <meta name="subject" content="Training">
  <meta name="copyright" content="Safety First Consulting">
  <meta name="language" content="ES">
  <meta name="Classification" content="Business">
  <meta name="author" content="KDE Technology">
  <meta name="designer" content="KDE Technology">
  <meta name="owner" content="Safety First Consulting">
  <meta name="url" content="https://safetyfirstconsulting.org">
  <meta name="identifier-URL" content="https://www.safetyfirstconsulting.org">
  <meta name="directory" content="submission">
  <meta name="category" content="Training">
  <meta name="coverage" content="Worldwide">
  <meta name="distribution" content="Global">
  <meta name="rating" content="General">

  <meta property="og:title" content="Safety First Consulting" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.safetyfirstconsulting.org" />
  <meta property="og:image" content="https://www.safetyfirstconsulting.org/img/fb-logo.jpg" />
  <meta property="og:site_name" content="Safety First Consulting" />
  <meta property="og:description"
    content="At Safety First Consulting we are brokers not agents. The dictionary definition of an Training broker is a licensed representative that represents the interests of his or her clients." />
  <!-- <meta property="fb:page_id" content="" /> -->

  <meta property="og:country-name" content="USA" />
  <link href="/img/favicon.png" rel="shortcut icon" />
  <title>Safety First Consulting ｜@yield('title')</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/css/style.css" type="text/css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="/css/fontawesome.css">
  @yield('head')

</head>

<body>
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
          <a class="nav-link" href="/About">About</a>
        </li>
        <li
          class="nav-item  {{ Request::path() === 'OSHA-Training' ? 'active' : '' }} {{ Request::path() === 'New-Miner-Rraining' ? 'active' : '' }} {{ Request::path() === 'Experienced-Miner-Training' ? 'active' : '' }}">
          <a class="nav-link " href="https://{{ Request::getHttpHost() }}/#WWO" role="button">
            Training
          </a>
        </li>
        <li class="nav-item {{ Request::path() === 'Contact' ? 'active' : '' }}">
          <a class="nav-link" href="/contact" tabindex="-1" aria-disabled="true">Contact</a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn nav-btn my-2 my-sm-0" type="submit">Search</button>
            </form> -->
      <div class="my-2 my-lg-2">
        @guest
          <a href="/login" class="btn nav-btn my-2 my-sm-0 ml-3">Login</a>
        @else
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/img/avatar.png" width="40" height="40" class="rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                @if (auth()->user()->role == 'A')
                  <a class="dropdown-item" href="/admin/dashboard">Admin Dashboard</a>
                @endif
                <a class="dropdown-item" href="/Dashboard">Dashboard</a>
                <a class="dropdown-item" href="/my_certificates">My Cert</a>
                <a class="dropdown-item" href="/buy_class">Buy Classess</a>
                <a class="dropdown-item" href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                  Out</a>
              </div>
            </li>
          </ul>

          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
          </form>
        @endguest
      </div>
  </nav>
  @yield('content')
  <!-- Footer -->
  <footer class="page-footer font-small special-color-dark pt-5 mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 text-center">
          <img style="max-width: 200px" class="img-fluid " src="/img/Safety%20First%20Logo.png"> <br><br>

        </div>
        <div class="col-md-4 text-center quick-links">
          <h5 class="pb-1">Quick Links</h5>
          <p><a href="/drilling_blasting_explosives">DRILLING, BLASTING & EXPLOSIVES</a></p>
          <p><a href="/Miner-New-Experienced-Annual">SURFACE MINER</a></p>
          <p><a href="/Other-Training">HAZWOPER</a></p>
          <p><a href="/Other-Training">Employee Safety</a></p>
        </div>
        <div class="col-md-4 d-flex justify-content-center align-content-center m-4 m-md-0">
          <div class="text-center">
            <h5 style="color:#0200d7;" class="text-center">TRAINING DEVELOPED FROM <br>EXPERIENCE</h5>
            <a class="btn btn-outline-primary mt-3" href="mailTo:Support@kdetechnology.com">Technical
              Support <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
          </div>
        </div>

      </div>
    </div>
    <div class="text-center py-3">
      <script>
        new Date().getFullYear() > 2010 && document.write(new Date().getFullYear());
      </script> Safety First Consulting</p>
      Designed, Managed and Hosted by <a class="mos d-block d-md-inline" href="https://kdetechnology.com/"><span
          style="color: #F6D70A; text-shadow: 1px 1px #000"><strong>KDE Technology</strong></span></a>
    </div>
  </footer>


  <!-- Global site tag (gtag.js) - Google Analytics -->
  {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-NEPGPH7M02"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-NEPGPH7M02');
    </script> --}}
  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>
  @yield('script')
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120928100-51"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-120928100-51');
  </script>
</body>

</html>
