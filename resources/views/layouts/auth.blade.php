<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Frame - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon_frame.svg') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-frame.png') }}" />
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <style>
        .page-header {
          height: auto!important;
          max-height: 3500PX!important;
          background-size: contain!important;
        }
        .input-group .input-group-text {
          justify-content: left!important;
        }

        @media screen and (max-width: 980px) {
          .off-canvas-sidebar .wrapper-full-page .page-header {
            padding: 0px!important;
          }
        }

        .modal .modal-dialog {
          margin-top: 0px!important;
          height: 100%;
        }

        .modal-dialog {
          border: 1px solid #cccccc!important;
          border-radius: 6px;
          background-color: white;
          width: 90%!important;
          margin: 0 auto!important;
        }
    </style>

</head>

<body class="off-canvas-sidebar">

  @if(!\Request::is('team/accept_project/*') && !\Request::is('project_providers/*'))
    @include('auth.components.nav')
  @endif

@if(\Request::is('login'))
  <div class="wrapper">
@else
  <div class="wrapper wrapper-full-page">
@endif
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url({{ asset('img/login.jpg') }}); background-size: cover; background-position: top center;">

      <div class="container">
        @yield('container')
      </div>

      @if(!\Request::is('team/accept_project/*') && !\Request::is('project_providers/*'))
        @include('auth.components.footer')
      @endif

    </div>
  </div>

   <!-- Javascripts Plugins  -->
   <script src="{{ asset('/js/core/jquery-3.3.1.min.js') }}"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
   <script src="{{ asset('/js/core/popper.min.js') }}"></script>
   <script src="{{ asset('/js/core/bootstrap-material-design.min.js') }}"></script>
   <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
   <script src="{{ asset('/js/plugins/bootstrap-selectpicker.js') }}"></script>

   <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
   <script src="{{ asset('/js/plugins/jquery.dataTables.min.js') }}"></script>

   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('/js/core/material-dashboard.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('/js/frame.js') }}" type="text/javascript"></script>

  <script>
    $(document).ready(function(){
      $('.hide-footer').click(function(){
        $('.footer').hide('slow');
        $('.wrapper').removeClass('wrapper-full-page');
      });
      $('.show-footer').click(function(){
        $('.footer').show('slow');
        $('.wrapper').addClass('wrapper-full-page');
      });
    });
  </script>

  @yield('javascript')

</body>
</html>
