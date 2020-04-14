<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Training App</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Training App
                </a>
                <!--スマホサイズの時の見た目-->
                <ul class="visible-xs iphone-size-header">
                @guest
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li>
                        <a href="#">
                            <i class="fas fa-dumbbell nav-icons"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
                </ul>
                
                <!--PCサイズの時の見た目-->
                <div class="collapse navbar-collapse .hidden-xs" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home"><i class="fas fa-home nav-icons"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home/profile?id={{Auth::user()->id}}"><i class="far fa-address-book nav-icons"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-dumbbell nav-icons"></i></a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        @auth    
            <footer>
                <div id="footer-menu" class="d-block d-md-none">
                    <!--class="d-block d-sm-none"-->
                    <ul>
                        <li><a href="/home"><i class="fas fa-home nav-icons"></i></a></li>
                        <li><a href="#"><i class="far fa-address-book nav-icons"></i></a></li>
                        <li><a href="#"><i class="fas fa-dumbbell nav-icons"></i></a></li>
                        <!--<li><a href="#header">TOPへ</a></li>-->
                    </ul>
                </div>
            </footer>
        @endauth
        </main>
    </div>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
