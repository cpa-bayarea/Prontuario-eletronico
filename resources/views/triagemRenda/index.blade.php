<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Antonio RS-PC-->
<!-- * Date: 06/07/2017-->
<!-- * Time: 12:44-->
<!-- */-->

@extends('templates/principal')
@section('titulo','Listagem de Triagem de Renda')

@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Listagem de Triagem de Renda</h4>
                    </div>
                    <table class="striped bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $dado)
                            <tr>
                                <td>

                                    <a class="waves-effect waves-light"
                                       href="triagemRenda/alterar/{{$dado['fk_origem_renda']}}"><i
                                                class="material-icons left">mode_edit</i></a>
                                    <a href="triagemRenda/deletar/{{$dado['fk_origem_renda']}}"><i
                                                class="material-icons left red-text"
                                                onclick="return confirm('Tem certeza que deseja deletar?')">delete</i></a>
                                </td>
                                <td>{{$dado['tx_nome']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="right-align">
                    <a class="btn-floating btn-large waves-effect waves-light" href="{{route('triagemRenda.form')}}"><i
                                class="material-icons">add</i></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function EventAlert() {
            swal({
                    title: "Deseja deletar?",
                    text: "Não podera recuperar esse arquivo novamente!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0b3",
                    cancelButtonColor: "#b11",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal("Deletado!", "Supervisor deletado.", "success");
                    } else {
                        swal("Cancelled", "Cancelado", "error");
                    }
                });
        }
    </script>
@endsection