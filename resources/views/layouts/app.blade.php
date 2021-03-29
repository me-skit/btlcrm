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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
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
                                    {{ __('Miembros') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownFamilias">
                                    <a class="dropdown-item" href="{{ route('people.index') }}">{{ __('Listado General') }}</a>
                                    <a class="dropdown-item" href="{{ route('families.index') }}">{{ __('Por Familias') }}</a>
                                    <a class="dropdown-item" href="{{ route('people.nomembers') }}">{{ __('No Miembros') }}</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="dropdownAdmin" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Catálogos') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
                                    <a class="dropdown-item" href="{{ route('villages.index') }}">{{ __('Poblados') }}</a>
                                    <a class="dropdown-item" href="{{ route('campus.index') }}">{{ __('Sedes') }}</a>
                                    <a class="dropdown-item" href="{{ route('privileges.index') }}">{{ __('Privilegios') }}</a>
                                    <a class="dropdown-item" href="{{ route('privilegeroles.index') }}">{{ __('Puestos en Privilegios') }}</a>
                                </div>
                            </li>                            

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->role }}: {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">{{ __('Cambiar Contraseña') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
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

        <main class="py-4">
            <div class="container">
                @include('layouts.flash-message')
            </div>

            @yield('content')
        </main>
    </div>
</body>
</html>
