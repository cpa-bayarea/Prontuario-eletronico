@extends('layouts.layout')

@section('title', 'Lista de Supervisor')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Supervisor</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Usuários</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Supervisor</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn-small btn btn-success" href="{{ route('supervisor.create') }}">
                    <span class="glyphicon glyphicon-plus"></span>Novo
                </a>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de Supervisores</h5>
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
                                    <th>Linha Teórica</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supervisores as $supervisor)
                                    <tr>
                                        <td align="center">
                                            <a href="edit/{{ $supervisor->id_supervisor }}"
                                               class="glyphicon glyphicon-pencil">
                                            </a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="destroy/{{ $supervisor->id_supervisor }}"
                                               class="glyphicon glyphicon-trash">

                                            </a>
                                        </td>
                                        <td> {{ $supervisor->tx_nome }}</td>
                                        <td> {{ $supervisor->nome_linha }}</td>
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

@endsection
