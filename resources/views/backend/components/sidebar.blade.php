<?php 
  $listPermissions = \App\User::getListPermissionsFromUser(Auth::user());
?>

<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('img/login.jpg') }}">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
    Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ url('/') }}" class="simple-text logo-normal text-header-frame">
      Frame
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{ asset('/img/avatar_male_default.png') }}" />
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username none-alert">
          <span>
            {{ Auth::user()->name.' '.Auth::user()->last_name }}
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <!-- <li class="nav-item nav-check-url">
              <a class="nav-link" href="{{ url('/users').'/'.Auth::user()->id }}">
                <span class="sidebar-mini"> VP </span>
                <span class="sidebar-normal"> Ver Perfil </span>
              </a>
            </li> -->
            <li class="nav-item nav-check-url">
              <a class="nav-link" href="{{ url('/users').'/'.Auth::user()->id.'/edit' }}">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal"> Editar Perfil </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">
                <span class="sidebar-mini"> CS </span>
                <span class="sidebar-normal"> Cerrar Sesión </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">

      @if(in_array("1", $listPermissions) || in_array("2", $listPermissions) || in_array("14", $listPermissions) || in_array("15", $listPermissions) || in_array("16", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/projects') }}">
            <i class="material-icons">list_alt</i>
            <p> Proyectos </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("9", $listPermissions) || in_array("14", $listPermissions) || in_array("15", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/projects_jornadas') }}">
            <i class="material-icons">calendar_today</i>
            <p> Jornadas de Proyectos </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("10", $listPermissions) || in_array("16", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/center_costs') }}">
            <i class="material-icons">business</i>
            <p> Centro de Costos </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("11", $listPermissions) || in_array("15", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/callsheet') }}">
            <i class="material-icons">calendar_view_day</i>
            <p> CallSheet </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("4", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/clients') }}">
            <i class="material-icons">people</i>
            <p> Clientes </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("3", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/providers') }}">
            <i class="material-icons">people_outline</i>
            <p> Teams </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("12", $listPermissions) || in_array("5", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/workers_categories') }}">
            <i class="material-icons">group_work</i>
            <p> Categorías SAT </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("13", $listPermissions) || in_array("5", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/frame_functions') }}">
            <i class="material-icons">functions</i>
            <p> Funciones Frame </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("8", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link" href="{{ url('/reports') }}">
            <i class="material-icons">reports</i>
            <p> Reportes </p>
          </a>
        </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("6", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link none-alert" data-toggle="collapse" href="#users-nav-menu">
            <i class="material-icons">people</i>
            <p> Usuarios
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="users-nav-menu">
            <ul class="nav">
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/users') }}">
                  <span class="sidebar-mini"> U </span>
                  <span class="sidebar-normal"> Usuarios </span>
                </a>
              </li>
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/roles') }}">
                  <span class="sidebar-mini"> R </span>
                  <span class="sidebar-normal"> Roles </span>
                </a>
              </li>
            </ul>
          </div>
            </li>
      @endif

      @if(in_array("1", $listPermissions) || in_array("3", $listPermissions))
        <li class="nav-item nav-check-url ">
          <a class="nav-link none-alert" data-toggle="collapse" href="#utilities-nav-menu">
            <i class="material-icons">list</i>
            <p> Utilidades
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse" id="utilities-nav-menu">
            <ul class="nav">
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/utilities/proyect_categories') }}">
                  <span class="sidebar-mini"> TP </span>
                  <span class="sidebar-normal"> Tipos de Proyectos </span>
                </a>
              </li>
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/utilities/contracts') }}">
                  <span class="sidebar-mini"> TC </span>
                  <span class="sidebar-normal"> Tipos de Contratos </span>
                </a>
              </li>
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/utilities/workdays') }}">
                  <span class="sidebar-mini"> JP </span>
                  <span class="sidebar-normal"> Jornadas de Trabajos </span>
                </a>
              </li>
              <li class="nav-item nav-check-url ">
                  <a class="nav-link" href="{{ url('/utilities/holidays') }}">
                    <span class="sidebar-mini"> FN </span>
                    <span class="sidebar-normal"> Feriados Nacionales </span>
                  </a>
                </li>
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/utilities/studies') }}">
                  <span class="sidebar-mini"> NE </span>
                  <span class="sidebar-normal"> Niveles Educativos </span>
                </a>
              </li>
              <li class="nav-item nav-check-url ">
                <a class="nav-link" href="{{ url('/utilities/countries') }}">
                  <span class="sidebar-mini"> P </span>
                  <span class="sidebar-normal"> Paises </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endif

    </ul>
  </div>
</div>
