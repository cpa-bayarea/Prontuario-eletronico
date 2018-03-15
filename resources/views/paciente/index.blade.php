@extends('templates/principal')
@section('titulo', 'Listagem de Pacientes')
@section('conteudo')


    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Lista de Pacientes</h4>
                    </div>
                    <table class="highlight bordered responsive-table">
                        <thead>
                        <tr>
                            <th>Ações</th>
                            <!--   <th>Id</th> -->
                            <th>Nome</th>
                            <!--  <th>Responsavel</th> -->
                            <th>Nascimento</th>
                            <!--  <th>Endereço</th> -->
                            <!--  <th>Número</th> -->
                            <!-- <th>UF</th> -->
                            <!-- <th>Bairro</th> -->
                            <!-- <th>Cidade</th> -->
                            <th>CPF</th>
                            <!--  <th>RG</th> -->
                            <th>Triagem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $dado)

                            <tr>
                                <td><a class="waves-effect waves-light"
                                       href="paciente/alterar/{{$dado['id_paciente']}}"><i
                                                class="material-icons left">mode_edit</i></a>

                                    <a href="#" onclick="deletar({{$dado['id_paciente']}})"><i
                                                class="material-icons left red-text">delete</i></a>
                                </td>
                            <!--  <td>{{$dado['id_paciente']}}</td> -->
                                <td>{{$dado['tx_nome']}}</td>
                            <!--  <td>{{ $dado['tx_nome_responsavel']}}</td> -->
                                <td>{{ $dado['dt_nascimento']}}</td>
                            <!--  <td>{{ $dado['tx_endereco']}}</td> -->
                            <!--  <td>{{ $dado['nu_numero']}}</td> -->
                            <!--  <td>{{ $dado['tx_uf']}}</td> -->
                            <!--  <td>{{ $dado['tx_bairro']}}</td> -->
                            <!--  <td>{{ $dado['tx_cidade']}}</td> -->
                                <td>{{ $dado['nu_cpf']}}</td>
                            <!--  <td>{{ $dado['nu_rg']}}</td> -->
                                <td>

                                    <a href="triagem/form/{{$dado['id_paciente']}}">Iniciar Triagem</a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="right-align">
                    <a class="btn-floating btn-large waves-effect waves-light"
                       href="{{route('paciente.form')}}"><i
                                class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>

        function deletar(id) {

            console.log(id);
            swal({
                title: 'Tem certeza?', // título
                text: 'O Paciente será apagado ! (' + id + ')',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0c3', // cor do botao de confirmar
                confirmButtonText: 'Sim',
                cancelButtonColor: '#b11', // cor do botao de cancelar
                cancelButtonText: 'Não'

            }).then(function (result) {
                if (result.value) {
                    window.open('/paciente/deletar/' + id, '_self');
                    swal(
                        'Sucesso !', 'Paciente deletado !', 'success'
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