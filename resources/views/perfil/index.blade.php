@extends('layouts.layout')
@section('content')
    <div class="content">
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-header">
                        <h5 class="card-title text-center">Lista de Perfis</h5>
                        <p>Confira aqui os perfis</p>
                    </div>
                    <div align="center">
                        <a class="btn btn-round btn-outline-success"
                           href="{{ route('perfil.create') }}">
                            <span>Cadastre um Novo <i class="fa fa-plus"></i> </span>
                        </a>
                    </div>
                    <div class="card-body ">
                        {{-- Realizar um laço nos tipos de projetos e mostra-los aqui --}}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>Ações</td>
                                <td>Nome do Demandante</td>
                                @can('Admin')
                                    <td>Status</td>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($perfis as $perfil)
                                <tr>
                                    <td>
                                        <a class="btn btn-round btn-outline-warning"
                                           href="edit/{{ $perfil['id_perfil'] }}">
                                            <span>Editar </span><i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-round btn-outline-danger"
                                           href="destroy/{{ $perfil['id_perfil'] }}">
                                            <span>Inativar </span><i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$perfil->nome}}</td>
                                    @can('Admin')
                                        <td>{{$perfil->status}}</td>
                                    @endcan
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
