<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Antonio RS-PC-->
<!-- * Date: 07/07/2017-->
<!-- * Time: 10:50-->
<!-- */-->

@extends('templates/principal')
<!-- Adicionando Javascript -->
@section('conteudo')
    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Triagem de drogas</h4>
                    </div>
                    <form method="post" action={{route('triagemDrogas.salvar')}}>
                        <div class="input-field col s6">
                            <select name="fk_triagem">
                                @foreach($dados as $dado)
                                    <option value="{{$dado['id_triagem']}}">{{$dado['tx_nome']}}</option>
                                @endforeach
                            </select>
                            <label for="tx_nome">Triagem</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="fk_doenca">
                                @foreach($dados2 as $dado)
                                    <option value="{{$dado['id_doenca']}}">{{$dado['tx_nome']}}</option>
                                @endforeach
                            </select>
                            <label for="tx_nome">Doença</label>
                        </div>
                        <input type="submit" value="Salvar" id="salvar" align="center" name="salvar" onclick=""
                               class="btn btn-success">
                        <a href="{{route('triagemDrogas.index')}}" class="btn red">Cancelar</a>


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