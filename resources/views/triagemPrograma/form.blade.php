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
                        <h4 class="grey-text" align="center">Triagem programa</h4>
                    </div>
                    <form method="post" action={{route('triagemPrograma.salvar')}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s6">
                                <select name="fk_triagem">
                                    @foreach($dados as $dado)
                                        {{--<option value="" disabled selected>Selecione supervisor</option>--}}
                                        <option value="{{$dado['id_triagem']}}">{{$dado['tx_nome']}}</option>
                                    @endforeach
                                </select>
                                <label for="supervisor">Supervisor:</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="fk_programa_social">
                                    @foreach($dados2 as $dado)
                                        {{--<option value="" disabled selected>Selecione supervisor</option>--}}
                                        <option value="{{$dado['id_programa_social']}}">{{$dado['tx_nome']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="Salvar" id="salvar" name="salvar" onclick="EventAlert()"
                                   class="btn btn-success">
                            <a href="{{route('triagemPrograma.index')}}" class="btn red">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
    $('select').material_select();
    });

    </script>

@endsection
