{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: Antonio RS-PC--}}
 {{--* Date: 16/07/2017--}}
 {{--* Time: 14:43--}}
 {{--*/--}}
<html>
<head>
    <title>@yield('titulo')</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="blue-grey lighten-5">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.maskedinput.js')}}"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweetalert.min.js')}}"></script>

<nav>
    <div class="nav-wrapper #3949ab indigo darken-1">
        <a href="#!" class="brand-logo">Logo</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="sass.html">Masculino</a></li>
            <li><a href="sass.html">Feminino</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="sass.html">Masculino</a></li>
            <li><a href="sass.html">Feminino</a></li>
        </ul>
    </div>
</nav>

@yield('conteudo')

<main>
    @if(Session::has('mensagem'))
        <div class="container">
            <div class="row">
                <div class="card {{''}}"></div>
            </div>
        </div>
    @endif
</main>
</body>
<script>
    $(document).ready(function () {
        $(".button-collapse").sideNav();
    });
</script>
</html>
