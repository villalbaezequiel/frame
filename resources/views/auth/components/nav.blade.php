<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="">@yield('title')</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item  nav-check-url">
          <a href="{{ url('/login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> Iniciar Sesión
          </a>
        </li>
        <li class="nav-item nav-check-url">
          <a href="{{ url('/register') }}" class="nav-link">
            <i class="material-icons">person_add</i> Registráte
          </a>
        </li>
        <li class="nav-item nav-check-url">
          <a href="{{ url('/password/reset') }}" class="nav-link">
            <i class="material-icons">lock_open</i> ¿Olvidaste tu contraseña?
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
