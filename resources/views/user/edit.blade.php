@extends('layouts.layout')

@section('title', 'Editar Linha Teórica')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Linha Teórica</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Apoio</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Linha Teórica</strong>
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

                        <form class="form-horizontal" action="{{ route('linha.store') }}" method="post">
                            @csrf
                            <div id="oculto">
                                <input type="number" name="id_theoretical_line"
                                       value="{{ $linha->id_theoretical_line }}" hidden>
                            </div>

                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Nome <span class="obrigatorio">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" value="{{ $linha->tx_name }}" name="tx_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dsc" class="col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dsc" value="{{ $linha->tx_desc }}" name="tx_desc">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sta" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    @php
                                        $checked = ($linha->status == "A") ? 'checked' : '';
                                    @endphp
                                    <input type="checkbox" id="switchery" class="js-switch" @php echo $checked @endphp name="status" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-send"></span>
                                        Salvar
                                    </button>
                                    <a href="{{ route('linha.index') }}" class="btn btn-danger">
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

    <!-- <div class="col-lg-10 offset-lg-4">
        <label for="status">Status <span class="obrigatorio">*</span></label>
        <input type="radio" class="form-control" name="status" id="status"
               o </span>
        <input type="radio" class="form-control" name="status" id="status"
               o </span>
        <br>
    </div> -->

@endsection
