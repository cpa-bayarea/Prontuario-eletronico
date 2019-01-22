@extends('layouts.layout')

@section('title', 'Cadastro de Supervisor')
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
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Dados Gerais</h5>
                    </div>
                    <div class="ibox-content">

                        <form class="form-horizontal" action="{{ route('supervisor.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Nome <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" name="tx_nome" required maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="crp" class="col-sm-2 control-label">CRP <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="crp" name="nu_crp" maxlength="7" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="linha_teorica" class="col-sm-2 control-label">{{ __('Linha Teórica') }}<span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <select name="id_linha" class="form-control" id="linha_teorica" required>
                                        <option selected disabled>Selecione</option>
                                        @foreach($linhas as $linha)
                                            <option class="form-control" value="{{ $linha->id_linha }}">{{ $linha->tx_nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="matricula" class="col-sm-2 control-label">Matrícula <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="matricula" name="nu_matricula" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefone" class="col-sm-2 control-label">Telefone <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="telefone" name="nu_telefone" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="col-sm-2 control-label">Celular</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="celular" name="nu_celular" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">E-mail <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="tx_email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Senha <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="tx_senha" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-send"></span>
                                        Salvar
                                    </button>
                                    <a href="{{ route('supervisor.index') }}" class="btn btn-danger">
                                        <span class="fa fa-reply"></span>
                                        Voltar
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
