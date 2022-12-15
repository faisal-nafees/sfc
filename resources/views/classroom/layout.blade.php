<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/css/adminDash.css" type="text/css">
  <link rel="stylesheet" type="/text/css" href="rev-slider-files/css/settings.css">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="/css/fontawesome.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.css' integrity='sha512-ecfz7BsZIyMBMdXTx7GU2128lQ7MTiqGJwAqCumba6v8y7YDhYEHueqy+iUtUdZsnsKhCyoCcFGGMhpwQOy6xg==' crossorigin='anonymous'/>

  @yield('head')

  <title>Dashboard</title>
</head>

<body>

  @include('inc.user.header')

  <div class="container-fluid">
    <div class="row">

      @include('inc.user.sidebar')

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

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
    <script src="/js/SourceFixer.js"></script>
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js' integrity='sha512-zrRn+TvTc4KgDOtlKOgThphx1DGCZ8zR/xGWtG/WiKp6G+/xUBWow3p2lWu8DHfdHYWfwvIY0I89b3q22POHSw==' crossorigin='anonymous'></script>
  {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js' integrity='sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==' crossorigin='anonymous'></script> --}}
  <script src="/js/script.js"></script>
  <script>
    //   <!-- ------------------------------ Analytics ------------------------------ -->
    function analyticLivePing() {
      var url = "{{ route('analyticLivePing') }}";
      $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
          console.log(data);
        }
      });
    }

    //   function analyticStop() {
    //     var url = "{{ route('analyticStop') }}";
    //     $.ajax({
    //       url: url,
    //       type: 'GET',
    //       success: function(data) {
    //         console.log(data);
    //       }
    //     });
    //   }

    setInterval(() => {
      analyticLivePing();
    }, 260000);
  </script>
  @yield('script')

</body>

</html>
