@extends('templates/principal')
@section('conteudo')



    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Cadastro de Paciente</h4>
                    </div>
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab"><a href="#test4">Parte 1</a></li>
                            <li class="tab"><a href="#test5">Parte 2</a></li>
                            <li class="tab"><a href="#test6">Parte 3</a></li>
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">
                        <form method="post" action={{route('paciente.salvar')}}>
                            {{ csrf_field() }}
                            <div id="test4">
                                <div id="oculto">
                                    <input type="number" name="id_supervisor" id="id_supervisor"
                                           value="{{$dados['id_supervisor'] or null}}" hidden>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_nome" value="{{$dados['tx_nome'] or null}}" name="tx_nome"
                                           required class="validate"/>
                                    <label for="tx_nome" class="">Nome</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="nu_cpf" name="nu_cpf" value="{{$dados['nu_cpf'] or null}}"
                                           required
                                           class="validate"/>
                                    <label for="nu_cpf">CPF:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="nu_rg" name="nu_rg" value="{{$dados['nu_rg'] or null}}"
                                           required
                                           class="validate"/>
                                    <label for="nu_rg">RG:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_naturalidade" name="tx_naturalidade"
                                           value="{{$dados['tx_naturalidade'] or null}}" required class="validate"/>
                                    <label for="email">Naturalidade:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_uf_naturalidade" name="tx_uf_naturalidade"
                                           value="{{$dados['tx_uf_naturalidade'] or null}}" required
                                           class="validate"/>
                                    <label for="tx_uf_naturalidade">UF naturalidade:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_uf_orgao" name="tx_uf_orgao"
                                           value="{{$dados['tx_uf_orgao'] or null}}" required class="validate"/>
                                    <label for="tx_uf_orgao">UF orgão:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_orgao_expe" name="tx_orgao_expe"
                                           value="{{$dados['tx_orgao_expe'] or null}}" required class="validate">
                                    <label for="orgao">Orgão espedidor</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_nome_responsavel" name="tx_nome_responsavel"
                                           value="{{$dados['tx__nome_responsavel'] or null}}" required
                                           class="validate"/>
                                    <label for="tx_nome_responsavel">Responsavel:</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" id="tx_parentesco" name="tx_parentesco"
                                           value="{{$dados['tx_parentesco'] or null}}" required class="validate"/>
                                    <label for="tx_parentesco">Parentesco:</label>
                                </div>
                            </div>
                            <div id="test5">Test 2b

                            </div>
                            <div id="test6">Test 3c

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection