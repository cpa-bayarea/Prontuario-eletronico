@extends('layouts.layout')

@section('title', 'Cadastro de Aluno')
@section('content')

    <script src="{{ asset('js/prontuario/aluno.js')}}"></script>

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
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Dados Gerais</h5>
                    </div>
                    <div class="ibox-content">

                        <form class="form-horizontal" action="{{ route('aluno.store') }}" method="post">
                            @csrf
                            <div id="oculto">
                                <input type="hidden" name="id_aluno" hidden id="aluno_id"
                                       value="{{ isset($aluno->id_aluno) ? $aluno->id_aluno : null }}">
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Nome
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" name="tx_nome"
                                           required maxlength="100"
                                           value="{{ isset($aluno->tx_nome) ? $aluno->tx_nome : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="semestre" class="col-sm-2 control-label">Semestre
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="semestre" name="nu_semestre"
                                           maxlength="2" required
                                           value="{{ isset($aluno->nu_semestre) ? $aluno->nu_semestre : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="supervisor" class="col-sm-2 control-label">{{ __('Supervisor') }}
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="id_supervisor" class="form-control" id="supervisor" required>
                                        <option selected disabled>Selecione</option>
                                        @foreach($supervisores as $supervisor)
                                            @if(isset($aluno))
                                                {{ $selected = ( $supervisor->id_supervisor === $aluno->id_supervisor) ? 'selected' : '' }}
                                            @endif
                                            <option class="form-control" {{ isset($selected) ? $selected : '' }}
                                                value="{{ $supervisor->id_supervisor }}"> {{ $supervisor->tx_nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="matricula" class="col-sm-2 control-label">Matrícula
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="matricula"
                                           name="nu_matricula" maxlength="11" required
                                           value="{{ isset($aluno->nu_matricula) ? $aluno->nu_matricula : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefone" class="col-sm-2 control-label">Telefone
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="telefone"
                                           name="nu_telefone" maxlength="11" required
                                           value="{{ isset($aluno->nu_telefone) ? $aluno->nu_telefone : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="col-sm-2 control-label">Celular</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control inteiro" id="celular"
                                           name="nu_celular" maxlength="11"
                                           value="{{ isset($aluno->nu_celular) ? $aluno->nu_celular : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">E-mail
                                    <span class="obrigatorio">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="tx_email" required
                                           value="{{ isset($aluno->tx_email) ? $aluno->tx_email : null }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Senha</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="tx_senha">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-send"></span>
                                        Salvar
                                    </button>
                                    <a href="{{ route('aluno.index') }}" class="btn btn-danger">
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
