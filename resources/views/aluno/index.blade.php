@extends('templates/principal')
@section('titulo', 'Listagem de Alunos')

@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Lista de Médicos/Alunos</h4>
                    </div>
                    <table class="highlight bordered responsive-table">
                        <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Fixo</th>
                            <th>Celular</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $dado)
                            <tr>
                                <td>

                                    <a href="{{url('aluno/deletar/'.$dado->id_aluno)}}" onclick=""><i
                                                class="material-icons left red-text">delete</i></a>
                                    <a class="waves-effect waves-light"
                                       href="{{url('aluno/alterar/'.$dado->id_aluno)}}"><i class="material-icons left">mode_edit</i></a>
                                </td>
                                <td>{{$dado['nu_codigo']}}</td>
                                <td>{{$dado['tx_nome']}}</td>
                                <td>{{$dado['nu_fone']}}</td>
                                <td>{{$dado['nu_fone2']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="right-align">
                    <a class="btn-floating btn-large waves-effect waves-light" href="{{route('aluno.incluir')}}"><i
                                class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deletar(id) {

            console.log(id);
            swal({
                title: 'Tem Certeza que deseja apagar esse Aluno? (' + id + ")",
                text: "O Aluno irá ser apagado!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0c3', // COR DO BOTÃO DE CONFIRMAR
                confirmButtonText: 'Sim',
                cancelButtonColor: '#b11',  // COR DO BOTÃO DE CANCELAR
                cancelButtonText: 'Não'
            }).then(function (result) {
                if (result.value) {
                    window.open('/aluno/deletar/' + id, '_self');
                    swal(
                        'Deletado!', 'Apagado com sucesso !', 'success'
                    );
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Operação Cancelada', 'Cadastro salvo com sucesso', 'error'
                    );
                }
            });
        }
    </script>

@endsection