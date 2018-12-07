@extends('layouts.layout')

@section('title', 'Cadastro de Usuários')
@section('content')

    <script src="{{ asset('js/user-edit.js')}}"></script>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Usuários</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Apoio</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Usuários</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Dados Gerais</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="m-t" role="form" method="POST" action="{{ route('user.store') }}">
                            @include('user/user-edit')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
