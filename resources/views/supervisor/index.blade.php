@extends('templates/principal')
@section('titulo', 'Listagem de Supervisores')
@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Lista de Supervisores</h4>
                    </div>
                    <table class="highlight bordered responsive-table">
                        <thead>
                        <tr>
                            <th>Ação</th>
                            <th>CRP</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $dado)
                            <tr>
                                <td><a class="waves-effect waves-light"
                                       href="supervisor/alterar/{{$dado['id_supervisor']}}"><i
                                                class="material-icons left">mode_edit</i></a>
                                    <!-- Para funcionar o Sweet Alert-->
                                    <a href="#" onclick="deletar({{$dado['id_supervisor']}})"><i
                                                class="material-icons left red-text">delete</i></a>
                                </td>
                                <td>{{$dado['nu_crp']}}</td>
                                <td>{{$dado['tx_nome']}}</td>
                                <td>{{$dado['nu_fone']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="right-align">
                    <a class="btn-floating btn-large waves-effect waves-light"
                       href="{{route('supervisor.form')}}"><i
                                class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
    <script>

        function deletar(id) {

            console.log(id);
            swal({
                title: 'Tem Certeza?', // TÍTULO DE AVISO
                text: 'O Supervisor será apagado ! (' + id + ')',  // SUBTÍTULO DE AVISO
                type: 'warning',   // TIPO DE AVISO (ÍCONE)
                showCancelButton: true,
                confirmButtonColor: '#00c853', // COR DO BOTÃO DE CONFIRMAR
                confirmButtonText: 'Sim',
                cancelButtonColor: '#b71c1c',  // COR DO BOTÃO DE CANCELAR
                cancelButtonText: 'Não'
            }).then(function (result) {
                if (result.value) {
                    window.open('/supervisor/deletar/' + id, '_self');
                    swal(
                        'Deletado!', 'Supervisor deletado !', 'success'
                    )
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Operação Cancelada', '', 'error'
                    )
                }
            })
        }
    </script>

@endsection