<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Welkom bij medical,
    Wij willen een toegankelijk plein in de wijk zijn, waar patiënten en buurtbewoners zich snel thuis voelen omdat onze zorg dichtbij en persoonlijk is. Een plek waar één zorgteam de bewoners goed kent en samenwerkt om de wijk gezond te maken en te houden.">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="employee-container container-lg">
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
                        <div class="float-right">
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
                        </div>
                        @else
                        <div class="float-right">
                            <li class="nav-item dropdown user">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="user">{{ Auth::user()->first_name . " " . Auth::user()->last_name}}</span>
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
                        </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="">

                @if (Session::get('message'))
                <div class="alert alert-success session-message">
                    {{ Session::get('message') }}
                </div>
                @endif

                @if (Session::get('err'))
                <div class="alert alert-danger session-message">
                    {{ Session::get('err') }}
                </div>
                @endif

                <div class="wrapper d-flex align-items-stretch">
                    <nav id="sidebar">
                        <div class="custom-menu">
                            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                                <i class="fa fa-bars" onclick="sidebar"></i>
                                <span class="sr-only">Toggle Menu</span>
                            </button>
                        </div>

                        <div class="p-4 pt-5">
                            <h1><a href="{{ route('employee.afspraken') }}" class="logo">Medical</a></h1>
                            <ul class="list-unstyled components mb-5">
                            <li class="active">
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Afspraken</a>
                                <ul class="collapse list-unstyled" id="homeSubmenu">
                                    <li>
                                        <a href="{{ route('employee.afspraken') }}"><div>Afspraken</div></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('afspraken.per.patient') }}"><div>Afspraken Per Patient</div></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('doctors') }}"><div>Huisartsen</div></a>
                            </li>
                            <li>
                                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Patienten</a>
                                <ul class="collapse list-unstyled" id="pageSubmenu">
                                    <li>
                                        <a href="/patienten"><div>Patienten</div></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('patienten.per.klacht') }}"><div>patienten per klacht</div></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#klachten" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Klachten</a>
                                <ul class="collapse list-unstyled" id="klachten">
                                    <li>
                                        <a href="{{ route('klachten') }}"><div>Klachten</div></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('klachten.per.patient') }}"><div>klachten Per Patient</div></a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                            <a href="#">Contact</a>
                            </li>
                            </ul>

                            <div class="mb-5">
                                        <h3 class="h6">Search</h3>
                                        <form action="#" class="colorlib-subscribe-form">
                                <div class="form-group d-flex">
                                    <div class="icon"><span class="icon-paper-plane"></span></div>
                                <input type="text" class="form-control" placeholder="Search">
                                </div>
                                </form>
                            </div>

                        </div>
                    </nav>

                    <div id="content" class="content pt-5">
                        @yield('content')
                    </div>
            </div>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
</body>
</html>
