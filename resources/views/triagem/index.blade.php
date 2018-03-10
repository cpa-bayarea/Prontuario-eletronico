@extends('templates/principal')

@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Lista de Triagem</h4>
                    </div>
                    <table class="striped bordered">
                        <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Codigo</th>
                            <th>Queixa</th>
                            <th>Observação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $dado)
                            <tr>
                                <td>
                                    <a class="waves-effect waves-light" href="triagem/alterar"><i
                                                class="material-icons left">mode_edit</i></a>

                                    <a href="triagem/deletar/{{$dado['id_triagem']}}"><i
                                                class="material-icons left red-text">delete</i></a>
                                </td>
                                <td>{{$dado['id_triagem']}}</td>
                                <td>{{$dado['tx_queixa']}}</td>
                                <td>{{$dado['tx_observacao']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="right-align">
                    <a class="btn-floating btn-large waves-effect waves-light" href="{{route('triagem.form')}}"><i
                                class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
@endsection