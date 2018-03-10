{{--///**--}}
{{--// * Created by PhpStorm.--}}
{{--// * User: Antonio RS-PC--}}
{{--// * Date: 06/07/2017--}}
{{--// * Time: 11:52--}}
{{--// */--}}

@extends('templates/principal')
@section('titulo', 'Cadastro de Aluno')

@section('conteudo')
    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Patrimonio</h4>
                    </div>
                    <form method="post" action={{route('programaSocial.salvar')}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div id="oculto">
                                <input type="number" name="id_supervisor" id="id_supervisor"
                                       value="{{$dados['id_programa_social'] or null}}" hidden>
                            </div>
                            <div class="input-field col s12">
                                <input id="tx_nome" name="tx_nome" type="text" class="validate" required
                                       value="{{$dados['tx_nome'] or null}}">
                                <label for="tx_nome">Patrimonio</label>
                            </div>

                            <input type="submit" value="Salvar" id="salvar" name="salvar" onclick="EventAlert()"
                                   class="btn btn-success">
                            <a href="{{route('programaSocial.index')}}" class="btn red">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
