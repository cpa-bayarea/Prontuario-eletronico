<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Project Controller
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/paper-dashboard.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/demo.css')}}" rel="stylesheet"/>
    <style>
        .obrigatorio {
            color: #ff0000;
        }
    </style>
</head>

<body>
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <i class="nc-icon nc-spaceship" style="font-size: 30px;"></i>
                </div>
            </a>
            <a href="/" class="simple-text logo-normal">
                PROJCTRL
            </a>
        </div>
        <div class="sidebar-wrapper">
            <!-- Right Side Of Navbar -->

            <ul class="nav">
                <li>
                    <a href="{{route('home')}}">
                        <i class="nc-icon nc-app"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="nc-icon nc-hat-3"></i>
                        <p>Gerência</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="nc-icon nc-trophy"></i>
                        <p>Time</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('demandantes.index')}}">
                        <i class="nc-icon nc-satisfied"></i>
                        <p>Product Owners</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('projeto.index')}}">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>Projetos</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('cargo.index')}}">
                        <i class="nc-icon nc-tile-56"></i>
                        <p>Cargo</p>
                    </a>
                </li>
                @can('Admin')
                    <li>
                        <a href="{{ route('perfil.index') }}">
                            <i class="nc-icon nc-controller-modern"></i>
                            <p>Perfil</p>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{route('tipo_projeto.index')}}">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Tipos de Projetos</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#">Project Controller</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <img src="{{url('storage/imgs/avatars/', Auth()->user()->avatar)}}"
                             style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px;">

                        <li class="nav-item">

                            <a class="nav-link btn-magnify mt-2" href="{{route('user.edit', Auth::user()->id)}}">
                                {{ Auth::user()->name }}
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="#">
                                <i class="nc-icon nc-time-alarm mr-3" style="font-size: 30px"></i>
                                Horas
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nc-icon nc-user-run mr-3" style="font-size: 30px"></i>
                                {{("  SAIR")}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    @yield('content')

    <!--   Core JS Files   -->
        <script src="{{asset('js/jquery.min.js')}}" defer></script>
        <script src="{{asset('js/popper.min.js')}}" defer></script>
        <script src="{{asset('js/bootstrap.min.js')}}" defer></script>
        <script src="{{asset('js/bootstrap.min.js')}}" defer></script>
        <script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" defer></script>
        <!-- Chart JS -->
        <script src="{{asset('js/chartjs.min.js')}}" defer></script>
        <script src="{{asset('js/demo.js')}}" defer></script>
        <!--  Notifications Plugin    -->
        <script src="{{asset('js/bootstrap-notify.js')}}" defer></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{asset('js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript" defer></script>
        <script src="{{asset('js/request_issue.js')}}" type="text/javascript" defer></script>
        <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
</body>


</html>
