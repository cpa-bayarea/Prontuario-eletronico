@extends('layouts.layout')

@section('title', 'Página Inicial')
@section('content')

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        Olá, {{ \App\Http\Controllers\UserController::getNome(Auth()->user()->username, Auth()->user()->tx_perfil) }}
                    </h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Página Inicial do Sistema
                                </div>
                                <div class="panel-body">
                                    <p>Navegue pelo menu a sua esquerda para usufriuir das funcionalidades do Prontuário
                                        Eletrônico.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
