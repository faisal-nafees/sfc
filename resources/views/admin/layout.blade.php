<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/css/adminDash.css" type="text/css">

  @yield('head')
  <!-- Fontawesome -->
  <link rel="stylesheet" href="/css/fontawesome.css">

  <title>Admin Dashboard</title>
</head>

<body style="width: 100%; overflow-x:hidden ">
  <div id="loading">
    <div class="loading-container">
      <div class="loader">Loading...</div>
    </div>
  </div>
  <!-- Toast/Alert -->
  <div class="toast-container toast-top-right"></div>
  <div class="toast-container toast-center-right"></div>
  <div class="toast-container toast-bottom-right"></div>

  @include('inc.admin.navbar')

  <div class="container-fluid body-container vw-100 overflow-hidden">
    <div class="row">

      @include('inc.admin.sidebar')

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 ">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb ml-3 mt-3">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            @yield('content')
      </main>
    </div>
  </div>




  <!-- Global site tag (gtag.js) - Google Analytics -->
  {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-NEPGPH7M02"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-NEPGPH7M02');
    </script> --}}

  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>
  <script src="/js/script.js"></script>

  {{-- <script src="/js/chart.js"></script> --}}
  @yield('finalScript')
  <script>
    $(window).on('load', function() {
      $('#loading').fadeOut();
    });
  </script>
</body>

</html>
