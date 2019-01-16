<div class="sidebar" data-color="purple" data-background-color="black" data-image="https://demos.creative-tim.com/material-dashboard-pro/assets/img/sidebar-1.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
    Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
      EM
    </a>
    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      Frame
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{ asset('/img/avatar_male_default.png') }}" />
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span>
            {{ Auth::user()->name.' '.Auth::user()->last_name }}
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal"> Mi Perfil </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal"> Editar Perfil </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item active ">
        <a class="nav-link" href="{{ url('/clients') }}">
          <i class="material-icons">people</i>
          <p> Clientes </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#utilities-nav-menu">
          <i class="material-icons">list</i>
          <p> Utilidades
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="utilities-nav-menu">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="{{ url('/utilities/proyect_categories') }}">
                <span class="sidebar-mini"> TP </span>
                <span class="sidebar-normal"> Tipos de Proyectos </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ url('/utilities/contracts') }}">
                <span class="sidebar-mini"> TC </span>
                <span class="sidebar-normal"> Tipos de Contratos </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ url('/utilities/workdays') }}">
                <span class="sidebar-mini"> JP </span>
                <span class="sidebar-normal"> Jornadas de Trabajos </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ url('/utilities/studies') }}">
                <span class="sidebar-mini"> NE </span>
                <span class="sidebar-normal"> Niveles Educativos </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ url('/utilities/countries') }}">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> Paises </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>
