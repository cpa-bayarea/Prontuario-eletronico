<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Antonio RS-PC-->
<!-- * Date: 06/07/2017-->
<!-- * Time: 12:44-->
<!-- */-->

@extends('templates/principal')

@section('conteudo')

<div class="row">
    <div class="col s10 offset-s1">
        <div class="card">
            <div class="card-content">
                <div>
                    <h4 class="grey-text" align="center">Lista de Doenças</h4>
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

                            <a class="waves-effect waves-light" href="triagemPatriomonio/alterar/{{$dado['fk_patrimonio']}}"><i
                                    class="material-icons left">mode_edit</i></a>
                            <a href="triagemPatriomonio/deletar/{{$dado['fk_patrimonio']}}"><i
                                    class="material-icons left red-text" onclick="return confirm('Tem certeza que deseja deletar?')">delete</i></a>
                        </td>
                        <td>{{$dado['tx_nome']}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="right-align">
                <a class="btn-floating btn-large waves-effect waves-light" href="{{route('triagemPatrimonio.form')}}"><i
                        class="material-icons">add</i></a>
            </div>
        </div>
    </div>
</div>
<script>
    function EventAlert(){
        swal({
                title: "Deseja deletar?",
                text: "Não podera recuperar esse arquivo novamente!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, apagar!",
                cancelButtonText: "Não, cancele por favor!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal("Deletado!", "Supervisor deletado.", "success");
                } else {
                    swal("Cancelled", "Cancelado :)", "error");
                }
            });
    }
</script>
@endsection