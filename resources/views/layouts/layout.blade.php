<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> @yield('title') </title>
        <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <link href="{{ asset('css/plugins/nouslider/jquery.nouislider.css') }}" rel="stylesheet">
        <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

        <link href="{{ asset('css/plugins/switchery/switchery.css') }}" rel="stylesheet">
        <style>
            /* todo => Adicionar template do estilo abaixo em um arquivo de css
               todo => para toodo o sistema
           */
            .obrigatorio{
                color: #ff0000;
            }

            #button-new{
                margin-left: 20px;
            }
        </style>
    </head>
    <body id="x">
        <!-- Mainly scripts -->
        <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Data Tables -->
        <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset('js/inspinia.js') }}"></script>
        <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

        <!-- Switchery -->
        <script src="{{ asset('js/plugins/switchery/switchery.js') }}"></script>
        {{-- Date Picker --}}
        <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
        {{-- NouSlider --}}
        <script src="{{ asset('js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>

        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation" style="position: fixed;">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <span>
                                    <img alt="image" class="img-circle" src="{{ asset('imgs/profile_small.jpg') }}"/>
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">David Williams</strong>
                                        </span>
                                        <span class="text-muted text-xs block">Art Director
                                            <b class="caret"></b>
                                        </span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Contacts</a></li>
                                    <li><a href="#">Mailbox</a></li>
                                    <li class="divider"></li>
                                    <li><a href="../usuario/logof.php">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                <a href="../home/index.php">PE+</a>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-th-large"></i>
                                <span class="nav-label">Principal</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ route('acolhimento.index') }}">Acolhimento</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span class="nav-label">Gerencial</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href="../aluno/index.php">Aluno</a>
                                </li>
                                <li>
                                    <a href="{{ route('supervisor.index') }}">Supervisor</a>
                                </li>
                                <li>
                                    <a href="../pagina/index.php">Página</a>
                                </li>
                                <li>
                                    <a href="../perfil/index.php">Perfis</a>
                                </li>
                            </ul>
                        </li>
                        @can('Admin')
                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="nav-label">Usuários</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="{{ route('user.index') }}">Gerenciar</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-cube"></i>
                                    <span class="nav-label">Apoio</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="{{ route('linha.index') }}">Linha Teórica</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0em;">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                @php
                                    # Pegando apenas o primeiro nome do usuário logado.
                                    $nome = explode(' ', ( Auth()->user()->tx_name));
                                @endphp
                                <span class="m-r-sm text-muted welcome-message">Seja bem vindo, @php echo $nome[0]; @endphp </span>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    {{("Sair")}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- end of navbar/sidebar  -->

                <script src="{{ asset('js/prontuario.js')}}"></script>
                @yield('content')

                <div class="footer">
                    <div class="pull-right">
                        Prontuário Eletrônico  &copy; 2017-<?= date('Y') ?>
                    </div>
                    <div>
                        <strong>Desenvolvido por:</strong> Centro de Práticas Acadêmicas Bay Area
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
