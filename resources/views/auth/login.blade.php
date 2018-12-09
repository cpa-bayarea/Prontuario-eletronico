@extends('layouts.navbar')

@section('titulo', 'Login')

@section('content')

    <script src="{{ asset('js/login.js')}}"></script>


    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Bem vindo ao Prontuário
                </div>
                <div class="panel-body">
                    <p>
                        <i class="fa fa-university"></i>
                            Desenvolvido pelos alunos do curso de Análise e Desenvolvimento de Sistemas.
                    </p>
                    <p>
                        <i class="fa fa-book"></i>
                        Um sistema simples e fácil para auxiliar e gerenciar seu trabalho na clínica de Psicologia do IESB-OESTE.
                    </p>

                    <p>
                        <i class="fa fa-comments"></i>
                            Tem Dúvida ou problema ? Entre em contato conosco
                        <a target="_blank" href="https://github.com/cpa-bayarea/Prontuario-eletronico/issues">Aqui</a> ou por email : <b>Implementar e-mail aqui</b>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox-content">
                <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username">{{ __('Matrícula') }}<span class="obrigatorio">*</span> </label>
                        <input type="text" id="username"
                            class="form-control inteiro{{ $errors->has('username') ? ' is-invalid' : '' }}"
                            name="username" value="{{ old('username') }}" required autofocus/>
                        @if ($errors->has('username'))
                            <div class="col-lg 3">
                                <p class="alert alert-danger alert-dismissable" role="alert">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <strong>{{ $errors->first('username') }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Senha') }}<span class="obrigatorio">*</span> </label>
                        <input type="password" id="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" required/>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback alert alert-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row mb-0 right">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary block full-width m-b">
                                <i class="fa fa-send"></i>
                                    {{ __('Acessar') }}
                            </button>
                        </div>
                    </div>

                    <p class="text-muted text-center">
                        <small>Você não tem uma conta?</small>
                    </p>
                    <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">
                        <i class="fa fa-user-plus"></i>
                        Solicitar acessso
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
