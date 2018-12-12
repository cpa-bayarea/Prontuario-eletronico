<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{  csrf_token() }}">

        <title> @yield('titulo') </title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <style>
            .obrigatorio {
                color: #ff0000;
            }
        </style>

    </head>

    <body class="gray-bg">
        <script src="{{ asset('js/jquery-2.1.1.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>

        {{-- Arquivo global de script do sistema. --}}
        <script src="{{ asset('js/prontuario.js')}}"></script>

        <div class="loginColumns animated fadeInDown">
            @yield('content')
            <hr/>
            <footer>
                <div class="row">
                    <div class="col-lg-6">
                        Centro de Práticas Acadêmicas - Bay Area
                        <p class="m-t bg">
                            Colocar âncora no nome citado acima redirecionado para o site da bay
                        </p>
                    </div>
                    <div class="col-lg-6 text-right">
                    <small>© 2017-<?= date('Y') ?></small>
                    </div>
                </div>
            </footer>
        </div>

    </body>

</html>
