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
                        <h4 class="grey-text" align="center">Triagem patrimonio</h4>
                    </div>
                    <form method="post" action={{route('triagemPatrimonio.salvar')}}>
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
                                <select name="fk_patrimonio">
                                    @foreach($dados2 as $dado)
                                        {{--<option value="" disabled selected>Selecione supervisor</option>--}}
                                        <option value="{{$dado['id_patrimonio']}}">{{$dado['tx_nome']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="Salvar" id="salvar" name="salvar" onclick="EventAlert()"
                                   class="btn btn-success">
                            <a href="{{route('triagemPatrimonio.index')}}" class="btn red">Cancelar</a>
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
