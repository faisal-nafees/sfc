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
	

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Toast/Alert -->
  <div class="toast-container custom"></div>
  <!-- Navbar -->

  <!-- Content -->
  <main>
    @yield('content')
  </main>
  <!-- Footer -->



  <!-- Global site tag (gtag.js) - Google Analytics -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="/js/front/bootstrap.js"></script>
  <!-- 3D Hover -->
  <script src="/js/front/jquery-3d-hover.plate.js"></script>
  <!-- Cursor -->

  @yield('script')
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
    /* --------------------------------- Loader --------------------------------- */
    setTimeout(() => {
      $("#loader").fadeToggle()
    }, 500)
    /* -------------------------------------------------------------------------- */

    /* --------------------------------- Cursor --------------------------------- */
    // var kursorx = new kursor({
    //   type: 2,
    //   color: '#221d41'
    // })
    // var kursorAlt = new kursor({
    //     type: 1,
    //     el: '.cursor-alt',
    //     color: '#2867fd'
    // })
    /* -------------------------------------------------------------------------- */

    /* ------------------------------- Hover Image ------------------------------ */
    if ($('.3d-hover').length) {
      $('.3d-hover').plate({
        // maximum rotation in degrees
        maxRotation: 5,
        // duration in milliseconds
        animationDuration: 500
      });
    }
    /* -------------------------------------------------------------------------- */

    /* ----------------------------------- Nav ---------------------------------- */
    window.onscroll = function(e) {
      if (window.scrollY >= 500) {
        $(".outer-menu").addClass('dark')
      } else {
        $(".outer-menu").removeClass('dark')
      }
    };
    $("#nav-menu li").on('click', function() {
      setTimeout(() => {
        $("#nav-menu .checkbox-toggle").click()
      }, 500)

    })
    /* -------------------------------------------------------------------------- */
  </script>

</body>

</html>
