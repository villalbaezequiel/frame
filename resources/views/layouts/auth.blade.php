<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Frame - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon_frame.svg') }}">
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">
  @include('auth.components.nav')

  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url({{ asset('img/login.jpg') }}); background-size: cover; background-position: top center;">

      <div class="container">
        @yield('container')
      </div>
      @include('auth.components.footer')

    </div>
  </div>

  <!-- Javascripts Plugins  -->
  <script src="{{ asset('/js/core/jquery-3.3.1.min.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('/js/plugins/jquery.dataTables.min.js') }}"></script>
  <!-- app Frame  -->
  <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

</body>
</html>
