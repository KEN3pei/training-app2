<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Training App</title>

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
    <!--vue.js-->
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
                                <a class="nav-link" href="/home"><i class="fas fa-home nav-icons"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/profile?id={{Auth::user()->id}}"><i class="far fa-address-book nav-icons"></i></a>
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
                        <li><a href="/profile?id={{Auth::user()->id}}"><i class="far fa-address-book nav-icons-center"></i></a></li>
                        <li><a href="#"><i class="fas fa-dumbbell nav-icons"></i></a></li>
                        <!--<li></li>-->
                    </ul>
                </div>
            </footer>
        @endauth
        </main>
        <!--<p>@{{msg}}</p>-->
        <!--<li v-for ="user in users">@{{ user.name }}</li>-->
        <!--<example-component></example-component>-->
        <!--<hello-component></hello-component>-->
    </div>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src=" {{ mix('js/app.js') }} "></script>
  
  <!--vue.js-->
  <!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>-->
  <!--<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>-->
  <script>

    //  new Vue({
    //   el: "#app",
    //   data: {
    //      msg: "Welcome",
    //      users: []
    //   },
    //   methods: {
    //      sayHello(){
    //       this.msg = "Hello!";
    //      }
    //   },
    //   created(){
    //      //表示後にやりたいことはここに書ける
    //      this.sayHello();
    //      axios.get('/users')
    //      .then(responce => this.users = responce.data)
    //      .catch(error => {
    //         console.info(error);
    //         });
    //     //  console.log(this.users);
    //   }
    //  });
   </script>
</body>
</html>
