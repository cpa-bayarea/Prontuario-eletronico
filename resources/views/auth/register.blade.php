@extends('layouts.navbar')

@section('titulo', 'Register')

@section('content')

    <script src="{{ asset('js/register.js')}}"></script>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user-plus"></i>
                    Solicitar acesso
                </div>
                    @if( session()->has('registered') )
                        <div class="panel-heading">
                            <p class="alert alert-success alert-dismissable" role="alert">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <strong>{{ session()->get('registered') }}</strong>
                                {{--<strong>Parabéns! Sua conta foi registrada com sucesso, a equipe de gestão do sistema irá avaliar suas credênciais.</strong>--}}
                            </p>
                        </div>
                    @endif
                <div class="ibox-content">
                    <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                        @include('user/user-form')
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
