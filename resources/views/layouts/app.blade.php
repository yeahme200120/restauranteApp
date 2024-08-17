<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Soporte') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Soporte') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row container-fluid justify-content-center">
            @if(auth()->user())
            <div class="col-2 bg-dark" style="height:92.5vh">
                <nav class="navbar navbar-light bg-light">
                    <ul class="list-group">
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/" data-toggle="tooltip" data-placement="right"
                                title="Usuarios">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                Usuarios
                            </a>
                        </li>
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/empresas" data-toggle="tooltip" data-placement="right"
                                title="Empresas">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                Empresas
                            </a>
                        </li>
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/provedores" data-toggle="tooltip" data-placement="right"
                                title="Provedores">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Provedores
                            </a>
                        </li>
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/productos" data-toggle="tooltip" data-placement="right"
                                title="Productos">
                                <i class="fa fa-cubes" aria-hidden="true"></i>
                                Productos
                            </a>
                        </li>
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/insumos" data-toggle="tooltip" data-placement="right"
                                title="Productos">
                                <i class="fa fa-cubes" aria-hidden="true"></i>
                                Insumos
                            </a>
                        </li>
                        <li class="list-group-item mt-3 p-0">
                            <a class="navbar-brand p-4" href="/productos" data-toggle="tooltip" data-placement="right"
                                title="Productos">
                                <i class="fa fa-th" aria-hidden="true"></i>
                                Catalogos
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
            <div class="col-10">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>

</html>
