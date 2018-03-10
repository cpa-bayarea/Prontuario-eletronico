@extends('templates/principal')
@section('titulo', 'Patrimônio')
@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Patrimonio</h4>
                    </div>
                    <form method="post" action={{route('patrimonio.salvar')}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div id="oculto">
                                <input type="number" name="id_supervisor" id="id_supervisor"
                                       value="{{$dados['id_patrimonio'] or null}}" hidden>
                            </div>
                            <div class="input-field col s12 l12">
                                <input id="tx_descricao" name="tx_descricao" class="validate" required
                                       value="{{$dados['tx_descricao'] or null}}">
                                <label for="tx_descricao">Patrimonio</label>
                            </div>
                            <input type="submit" value="Salvar" id="salvar" name="salvar" onclick="EventAlert()"
                                   class="btn btn-success">
                            <a href="{{route('patrimonio.index')}}" class="btn red">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
