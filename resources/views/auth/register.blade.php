@extends('layouts.navbar')

@section('titulo', 'Register')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Solicitar acesso
                </div>
                <div class="ibox-content">
                    <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Nome') }}</label>
                            <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nu_matricula">{{ __('Matrícula') }}</label>
                            <input id="nu_matricula" type="text"
                                    class="form-control inteiro{{ $errors->has('nu_matricula') ? ' is-invalid' : '' }}"
                                    name="nu_matricula" value="{{ old('nu_matricula') }}" required autofocus maxlenght="11">
                            @if ($errors->has('nu_matricula'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nu_matricula') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="perfil">{{ __('Perfil') }}</label>
                            <select name="id_perfil" class="form-control" id="perfil">
                                <option disabled selected>Selecione o Perfil</option>
                                <option value="1">Administrador</option>
                                <option value="2">Aluno</option>
                                <option value="3">Supervisor</option>
                                <option value="3">Secretária</option>
                                <option value="3">Terapeuta</option>
                            </select>

                            @if ($errors->has('perfil'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('perfil') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail') }}</label>
                            <input id="email" type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Senha') }}</label>
                            <input id="password" type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirme a senha') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                        </div>

                        <div class="form-group mb-0 right">
                            <button type="submit" class="btn btn-primary block full-width m-b">
                                {{ __('Cadastre-se') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
                    

@endsection
