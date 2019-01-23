@extends('layouts.layout')

@section('title', 'Lista de Aluno')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Aluno</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Usuários</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Aluno</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn-small btn btn-success" href="{{ route('aluno.create') }}">
                    <span class="glyphicon glyphicon-plus"></span>Novo
                </a>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de Alunos</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <table class="table table-striped table-bordered table-hover dataTables dataTable">
                                <thead>
                                <tr>
                                    <th width="5%">Ações</th>
                                    <th>Nome</th>
                                    <th>Semestre</th>
                                    <th>Supervisor</th>
                                    <th>E-mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($alunos as $aluno)
                                    <tr>
                                        <td align="center">
                                            <a href="edit/{{ $aluno->id_aluno }}"
                                               class="glyphicon glyphicon-pencil">
                                            </a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="#" onclick="deletar({{ $aluno->id_aluno }})"
                                               class="glyphicon glyphicon-trash">
                                            </a>
                                        </td>
                                        <td> {{ $aluno->tx_nome }}</td>
                                        <td> {{ $aluno->nu_semestre }}</td>
                                        <td> {{ $aluno->nome_supervisor }}</td>
                                        <td> {{ $aluno->tx_email }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deletar(aluno) {
            swal({
                    title: 'Atenção',
                    text: 'Tem certeza que deseja excluir este(a) Aluno(a) ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        type: 'POST',
                        url: '/aluno/destroy',
                        data: {_token: '{{ csrf_token() }}', id_aluno: aluno},
                        success: function (data) {
                            if(data.success){
                                swal('Deletado!', 'O registro do(a) aluno(a) foi deletado com sucesso!', 'success');
                                window.location.href = '/aluno/index';
                            }else{
                                console.log(data);
                            }
                        }
                    });
                });
        }
    </script>

@endsection
