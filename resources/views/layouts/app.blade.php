<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Medical') }}</title>
    <meta name="description" content="Welkom bij medical,
    Wij willen een toegankelijk plein in de wijk zijn, waar patiënten en buurtbewoners zich snel thuis voelen omdat onze zorg dichtbij en persoonlijk is. Een plek waar één zorgteam de bewoners goed kent en samenwerkt om de wijk gezond te maken en te houden.">
    <meta name="keywords" content="medical, huisarts">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-lg">
                @auth
                @if (Auth::user()->is_employee == true)
                    <a class="navbar-brand" href="{{ route('employee.afspraken') }}">
                        <h1>MEDICAL</h1>
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url("/home") }}">
                        <h1>MEDICAL</h1>
                    </a>
                @endif
                @endauth
                <div id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="dropdown ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown ml-auto">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"><span class="user">
                                    {{ Auth::user()->first_name . " " . Auth::user()->last_name}}</span>
                                    <i class="fa fa-user-circle fa-3x"></i></a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/profile/edit/{{ Auth::user()->id }}">Edit Profile</a>

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

        <main class="py-4">
            @livewire('home')
            @yield('content')
        </main>
    </div>

    @auth
        <footer class="my-footer">
            <div class="row text-center">
                <div class="col-md-3">
                    <h4>Privecyverklaring</h4>
                </div>

                <div class="col-md-3">
                    <h4>Cookiewetgeving</h4>
                </div>

                <div class="col-md-3">
                    <h4>Thuisarts.nl</h4>
                </div>

                <div class="col-md-3">
                    <h4>Patiëntomgeving</h4>
                </div>
            </div>
        </footer>
    @endauth

    @livewireScripts
</body>
</html>
