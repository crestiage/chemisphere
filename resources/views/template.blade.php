<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title)</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="resources/img/favicon.png" rel="icon">
    <link href="resources/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- theme-resources CSS Files -->
    <link href="resources/theme-resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/theme-resources/icofont/icofont.min.css" rel="stylesheet">
    <link href="resources/theme-resources/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="resources/theme-resources/animate.css/animate.min.css" rel="stylesheet">
    <link href="resources/theme-resources/venobox/venobox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="resources/css/style.css" rel="stylesheet">

    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>

  </html>