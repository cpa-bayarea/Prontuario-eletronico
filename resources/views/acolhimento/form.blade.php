@extends('layouts.layout')

@section('title', 'Ficha de Acolhimento')
@section('content')

    <script src="{{ asset('js/acolhimento.js')}}"></script>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Ficha de Acolhimento</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Principal</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Ficha de Acolhimento</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">

            <div class="col-lg-12">
                <div class="tabs-container">
                    <div class="tabs-left">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-6">Dados Gerais</a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#tab-7">This is second tab</a>
                            </li>
                        </ul>
                        <form class="form-horizontal" action="{{ route('acolhimento.store') }}" method="post">
                            @csrf
                            <div class="tab-content ">
                                <div id="tab-6" class="tab-pane active">
                                    <div class="panel-body">
                                        <strong>I - Dados Pessoais</strong>

                                        <div class="form-group"></div>
                                        <div class="form-group">
                                            <label for="dsc" class="col-sm-2 control-label">Nome Completo<span class="obrigatorio">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dsc" name="tx_desc">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dsc" class="col-sm-2 control-label">Nome Social<span class="obrigatorio">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dsc" name="tx_desc">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dsc" class="col-sm-2 control-label">Responsável<span class="obrigatorio">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dsc" name="tx_desc">
                                            </div>
                                        </div>
                                        <div class="form-group" id="data_1">
                                            <label for="date" class="col-sm-3 col-md-3 col-lg-2 control-label">Data:<span class="obrigatorio" title="Campo obrigatório">*</span></label>
                                            <div class="col-sm-9 col-md-9 col-lg-10 date">
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                    <input name="janfim" id="date" type="text" value="" class="form-control" required="required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="dsc" class="col-sm-2 control-label">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dsc" name="tx_desc">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-7" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Donec quam felis</strong>

                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--<div class="col-lg-6">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-3">
                                <i class="fa fa-laptop"></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-4">
                                <i class="fa fa-desktop"></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tab-5">
                                <i class="fa fa-database"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-3" class="tab-pane active">
                            <div class="panel-body">
                                <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                    existence in this spot, which was created for the bliss of souls like mine.</p>

                                <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                    the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis</strong>

                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis</strong>

                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}

        </div>
    </div>

@endsection