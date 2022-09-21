<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('Iglesia Bethel') }}</title>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top py-1">
      <div class="container">
        <a class="navbar-brand py-0" href="{{ url('/') }}">
          <img src="{{ asset('images/bethel_logo_white.png') }}" alt="" width="75">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            @auth
            <li class="nav-item dropdown">
              <a id="dropdownFamilias" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-church"></i> {{ __('Miembros') }}
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownFamilias">
                <a class="dropdown-item" href="{{ route('families.index') }}"><i class="fas fa-house-user fa-fw"></i> Por familias</a>
                @can('consult')
                <a class="dropdown-item" href="{{ route('members.index') }}"><i class="fas fa-users fa-fw"></i> Listado general</a>

                <div class="dropdown-submenu">
                  <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-poll-people fa-fw"></i> Consultas</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('members.queryform') }}"><i class="far fa-file-search fa-fw"></i> Consulta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('members.baptized') }}"><i class="fas fa-users fa-fw"></i> Bautizados</a>
                    <a class="dropdown-item" href="{{ route('members.unbaptized') }}"><i class="far fa-users fa-fw"></i> No bautizados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('members.accepted') }}"><i class="fas fa-users fa-fw"></i> Aceptados</a>
                    <a class="dropdown-item" href="{{ route('members.unaccepted') }}"><i class="far fa-users fa-fw"></i> No aceptados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('members.bypreferences') }}"><i class="fas fa-tasks fa-fw"></i> Por preferencias</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('members.withdiseases') }}"><i class="fas fa-procedures fa-fw"></i> Enfermos</a>
                    <a class="dropdown-item" href="{{ route('members.withhandicaps') }}"><i class="fas fa-wheelchair fa-fw"></i> Discapacitados</a>
                  </div>
                </div>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('nomembers.index') }}"><i class="far fa-user fa-fw"></i> No miembros</a>
                @endcan
                <div class="dropdown-divider"></div>
                <a class="dropdown-item disabled" href="#"><i class="fas fa-chart-pie fa-fw"></i> Estadísticas</a>
                <a class="dropdown-item" href="{{ route('families.mapping') }}"><i class="fas fa-map-marked-alt fa-fw"></i> Mapeo</a>
              </div>
            </li>

            @can('consult')
            <li class="nav-item dropdown">
                <a id="dropdownCatal" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fas fa-sitemap"></i> {{ __('Organización') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownCatal">
                  <a class="dropdown-item" href="{{ route('directory') }}"><i class="fas fa-user-tie fa-fw"></i> {{ __('Nomina de privilegios') }}</a>
                  @can('administer')
                    <a class="dropdown-item" href="{{ route('disciplines.index') }}"><i class="fas fa-user-lock fa-fw"></i> {{ __('Disciplinas') }}</a>                      
                  @endcan
                </div>
            </li>
            @endcan

            @can('administer')
            <li class="nav-item dropdown">
                <a id="dropdownAdmin" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fas fa-user-shield"></i> {{ __('Administrar') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
                  <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fas fa-user-cog fa-fw"></i> {{ __('Usuarios') }}</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('villages.index') }}"><i class="fas fa-map-marked-alt fa-fw"></i> {{ __('Pueblos y aldeas') }}</a>
                  <a class="dropdown-item" href="{{ route('campus.index') }}"><i class="fas fa-place-of-worship fa-fw"></i> {{ __('Sedes') }}</a>
                  <a class="dropdown-item" href="{{ route('privileges.index') }}"><i class="fas fa-user-tie fa-fw"></i> {{ __('Privilegios') }}</a>
                  <a class="dropdown-item" href="{{ route('privilegeroles.index') }}"><i class="fas fa-id-card-alt fa-fw"></i> {{ __('Puestos en privilegios') }}</a>
              </div>
            </li>
            @endcan

            @endauth
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            @auth
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fas fa-user-circle"></i> {{ Auth::user()->role_name }}: {{ Auth::user()->nickname }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('user.change') }}"><i class="fas fa-key fa-fw"></i> {{ __('Cambiar Contraseña') }}</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-door-open fa-fw"></i> {{ __('Cerrar Sesión') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-5">
      <div class="content pt-3 pb-2">
        <div class="container">
          @include('layouts.flash-message')
        </div>
  
        @yield('content')
      </div>
    </main>
  </div>
  <footer class="footer fixed-bottom bg-light">
    <div class="container my-2 text-center">
      <span class="text-muted">&copy {{ date("Y") }} Iglesia Bethel C.A. <span class="d-none d-md-inline">Patzicía, Chimaltenango, Guatemala</span></span>
    </div>
  </footer>
</body>
</html>