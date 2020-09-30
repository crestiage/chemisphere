<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$data["config"]["siteTitle"]}}</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('resources/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('resources/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <!-- theme-resources CSS Files -->
  <link href="{{ asset('resources/theme-resources/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/theme-resources/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/theme-resources/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/theme-resources/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('resources/theme-resources/venobox/venobox.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('resources/theme-resources/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/jquery-sticky/jquery.sticky.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('resources/theme-resources/venobox/venobox.min.js') }}"></script>

  <script>
    $(document).ajaxStart(function() {
      $('.loader').show(); // show the gif image when ajax starts
    }).ajaxStop(function() {
      $('.loader').hide(); // hide the gif image when ajax completes
    });
  </script>

  <!-- =======================================================
  * Template Name: Shuffle - v2.0.0
  * Template URL: https://bootstrapmade.com/bootstrap-3-one-page-template-free-shuffle/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>