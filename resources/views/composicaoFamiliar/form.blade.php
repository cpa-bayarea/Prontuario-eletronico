{{--/**--}}
{{--* Created by PhpStorm.--}}
{{--* User: Antonio RS-PC--}}
{{--* Date: 06/07/2017--}}
{{--* Time: 10:33--}}
{{--*/--}}

@extends('templates/principal')
<!-- Adicionando Javascript -->
@section('conteudo')
    <div class="row">
        <div class="row">
            <div class="card">
                <div class="card-content">
                    <div align="center">
                        <h4>Composição familiar</h4>
                    </div>

                    <form method="post" action={{route('composicaoFamiliar.salvar')}}>
                        {{ csrf_field() }}
                        <div id="oculto">
                            <input type="number" name="id_composicao_familiar" id="id_composicao_familiar"
                                   value="{{$dados['id_composicao_familiar'] or null}}" hidden>
                        </div>
                        <div class="input-field col  s12">
                            <input type="text" id="" name="tx_composicao" value="{{$dados['tx_composicao'] or null}}"
                                   required
                                   class="validate"/>
                            <label for="">Composição:</label>
                        </div>

                        <input type="submit" value="Salvar" id="salvar" align="center" name="salvar" onclick=""
                               class="btn btn-success">
                        <a href="{{route('composicaoFamiliar.index')}}" class="btn red">Cancelar</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        function EventAlert() {
            swal("Cadastro efetuado com sucesso!", "success")
        }

        $(document).ready(function () {
            $('select').material_select();
        });

    </script>
@endsection