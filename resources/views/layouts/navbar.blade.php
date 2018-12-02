
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
                    <small>© 2017-2018</small>
                    </div>
                </div>
            </footer>
        </div>

        <script src="{{ asset('js/jquery-2.1.1.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script>
            /**
             * Hide all form for anyone profile.
             * @since 01/12/2018
             */
            function hideAll()
            {
                $('.form-all').hide('fast');
                $('.form-alu').hide('fast');
                $('.form-sup').hide('fast');
                $('.all-profile').hide('fast');
            }

            function verificaCampos(str)
            {

                if(str == 3){
                    hideAll();
                    $('.form-sup').show('slow');
                    $('.all-profile').show('slow');
                    $('.form-all').show('slow');
                }else if(str == 2){
                    hideAll();
                    $('.all-profile').show('slow');
                    $('.form-alu').show('slow');
                    $('.form-all').show('slow');
                }else {
                    hideAll();
                    $('.all-profile').show('slow');
                    $('.form-all').show('slow');
                }
            }

            $(document).ready(function () {

                hideAll();

                $('#username').val('');

                // Faz validação se a matrícula informada existe.
                $('#username').keyup(function () {
                    var mat = $(this).val();

                    if (mat !== '') {
                        // Permite ao usuário informar sua senha.
                        $('#password').prop('disabled', false);
                    } else {
                        $('#password').prop('disabled', true);
                    }
                });

                if( $('#username').val() !== ''){
                    $('#password').prop('disabled', false);
                }else{
                    $('#password').prop('disabled', true);
                }

                $('#password').prop('title', 'Informe uma matrícula !');

                $('.inteiro').keyup(function () {
                    $($(this)).val($(this).val().replace(/[^0-9]/g, ''));
                });

                $("#id_perfil").change(function(){
                    var pfl = $(this).val();
                    verificaCampos(pfl);
                });

            });

        </script>
    </body>

</html>
