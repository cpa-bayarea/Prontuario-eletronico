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
                    <a>Apoio</a>
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
                        <div id="button-new">
                            <a class="btn-small btn btn-success" href="{{ route('supervisor.create') }}"
                               style="margin-left: 1em; ">
                                <span class="glyphicon glyphicon-plus"></span>Novo
                            </a>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <table class="table table-striped table-bordered table-hover dataTables dataTable">
                                <thead>
                                <tr>
                                    <th width="5%">Ações</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supervisors as $supervisor)
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
                                        <td> {{ $supervisor->tx_name }}</td>
                                        <td> {{ $supervisor->tx_desc }}</td>
                                        @php
                                            if( $supervisor->status == 'A'):
                                                $style = 'color: #0778ec; font-weight: bolder;';
                                            else:
                                                $style = 'color: #ff0000; font-weight: bolder;';
                                            endif
                                        @endphp
                                        <td style="{{$style}}"> {{ $supervisor->status }}</td>
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
