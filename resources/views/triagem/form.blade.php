@extends('templates/principal')
@section('titulo', 'Fomulário Triagem')

@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">

                <table class="col s11 offset-s1 center-align">
                    <thead>
                    <tr>
                        <th>Nome do Paciente</th>
                        <th>Nome do Aluno</th>
                        <th>Nome do Supervisor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$paciente->tx_nome}}</td>
                        <td>{{$aluno->tx_nome}}</td>
                        <td>{{$supervisor->tx_nome}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col s10 offset-s1">
                    <div class="card">
                        <div class="card-content">
                            <div class="col s12 center center-align">
                                <h1>Lista de triagem</h1>
                            </div>
                            <form method="post" action={{route('triagem.salvar')}}>
                                {{ csrf_field() }}
                                <div id="oculto">
                                    <input type="number" name="id_triagem" id="id_triagem"
                                           value="{{$paciente['id_triagem'] or null}}"
                                           hidden>
                                    <input type="number" name="fk_paciente" id="fk_paciente"
                                           value="{{$paciente['id_paciente'] or null}}"
                                           hidden>
                                    <input type="text" name="tx_responsavel" id="tx_responsavel"
                                           value="{{$paciente->tx_nome_responsavel}}"
                                           hidden>
                                    <input type="text" name="tp_grupo" id="tp_grupo"
                                           value='{{$paciente->tp_atendimento}}' hidden>
                                </div>
                                <div class="input-field col s12" align="left">
                                    <label name='queixa' class="active">Queixa principal:</label>
                                    <input class="validate" value="{{$paciente['tx_queixa'] or null}}" name="tx_queixa"
                                           id="queixa"
                                           required
                                           placeholder="Escreva o motivo da solicitação do atendimento utilizando ao máximo as palavras do paciente">
                                </div>
                                <div class="input-field col s6">
                                    <b>Necessidade atendimento:</b>
                                    <select active name="tp_necessidade_atendi">
                                        <option value="" active selected>Escolha uma opção</option>
                                        <option name="tp_necessidade_atendi" value="N">Normal</option>
                                        <option name="tp_necessidade_atendi" value="U">Urgente</option>
                                    </select></div>
                                <div class="input-field col s12" align="left">
                                    <label name='tx_observacao' class="active">Observações :</label>
                                    <input class="validate" value="{{$paciente['tx_observacao'] or null}}"
                                           name="tx_observacao" id="tx_observacao"
                                           required
                                           placeholder="">
                                </div>
                                <div class="input-field col s4">
                                    <label name="tp_recusa" class="active">Recusa:</label>
                                    <select active name="tp_recusa">
                                        <option value="" active selected>Escolha uma opção</option>
                                        <option name="tp_recusa" value="C">Caso encerrado.</option>
                                        <option name="tp_recusa" value="E">Encaminhamento externo.</option>
                                    </select>
                                </div>
                                <div class="input-field col s4">
                                    <label name="motivo" class="control-label">Motivo</label>
                                    <input type="text" id="motivo" name="tx_motivo_recusa" class="form-control">
                                </div>
                                <div class="input-field col s4" align="left">
                                    <label name="dtRecusa" class="active">Dt. recusa</label>
                                    <input type="date" id="dtRecusa" name="dt_recusa" class="validate">
                                </div>
                                <div class="input-field col s6" align="left">
                                    <select active name="tp_familia_estuda">
                                        <option value="" active selected>Escolha uma opção</option>
                                        <option value="S" name="tp_familia_estuda">Sim</option>
                                        <option value="N" name="tp_familia_estuda">Não</option>
                                    </select>
                                    <label>Alguem em sua residência estuda
                                        em escola ou faculdade
                                        partiular?</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" id="mensalidade" name="nu_mensalidade" required
                                           class="validate"/>
                                    <label name="mensalidade" class="active">Se sim. Qual o valor da
                                        mensalidade?</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" id="nPessoas" class="validate" required name="nu_qtd_pessoa">
                                    <label name="nPessoas" class="active">Quantas pessoas moram na sua
                                        casa?</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" id="nTrabalham" class="validate" name="nu_qtd_trabalha">
                                    <label name="nTrabalham" class="active">Quantos trabalham?</label>
                                </div>
                                <div class="input-field col s6">
                                    <label name="tp_deficiencia" class="active">Alguém de sua família tem
                                        alguma doença mental ou
                                        transtorno mental? </label>
                                    <select active name="tp_deficiencia">
                                    <option value="" active selected>Escolha uma opção</option>
                                    <option name="tp_deficiencia" value="S">Sim</option>
                                    <option name="tp_deficiencia" value="N">Não</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" id="tx_deficiencia" name="tx_deficiencia"
                                           class="validate">
                                    <label name="tx_deficiencia" class="active">Se sim. Qual?</label>
                                </div>
                                <div class="input-field col s6">
                                    <label name="tp_acompanhamento_psic" class="active">Você ou alguem da
                                        família faz acompanhamento psiquiátrico?</label>
                                    <select active name="tp_acompanhamento_psic">
                                        <option value="" active selected placeholder="Você ou alguem da
     família faz acompanhamento psiquiátrico?">Escolha uma opção
                                        </option>
                                        <option name="tp_acompanhamento_psic" value="S">Sim</option>
                                        <option name="tp_acompanhamento_psic" value="N">Não</option>
                                    </select>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" class="validate" id="tx_local_acompanhamento"
                                           name="tx_local_acompanhamento">
                                    <label class="active" name="tx_local_acompanhamento">Local do acompanhamento</label>
                                </div>
                                <div class="input-field col s3">
                                    <input type="text" class="validate" id="fk_gastos_saude"
                                           name="fk_gastos_saude">
                                    <label class="active" name="fk_gastos_saude">Mensalidade do local.</label>
                                </div>
                                <div class="input-field col s12">
                                    <label name="tp_acompanhamento" class="active">Tipo de acompanhamento ?</label>
                                    <select active name="tp_acompanhamento">
                                        <option value="" active selected placeholder="Você ou alguem da
     família faz acompanhamento psiquiátrico?">Escolha uma opção
                                        </option>
                                        <option name="tp_acompanhamento" value="U">Pública</option>
                                        <option name="tp_acompanhamento_" value="R">Privada</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <label name="tp_drogas" class="active">Você é usuário de drogas?</label>
                                    <select active name="tp_drogas">
                                        <option value="" active selected>Escolha uma opção</option>
                                        <option name="tp_drogas" value="S">Sim</option>
                                        <option name="tp_drogas" value="N">Não</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <label name="tx_patrimonio" class="active">Você é usuário de drogas?</label>
                                    <select active name="tx_patrimonio">
                                        <option value="" active selected>Escolha uma opção</option>
                                        <option name="tx_patrimonio">Própia (Quitada)</option>
                                        <option name="tx_patrimonio">Própia (Financiada)</option>
                                        <option name="tx_patrimonio">Alugada ()</option>
                                        <option name="tx_patrimonio">Cedida</option>
                                    </select>
                                </div>
                                <div class="input-field col s12" align="left">
                                    <label name='tx_relatorio_acolhimento' class="active">Relatório da Triagem :</label>
                                    <input class="validate" name="tx_relatorio_acolhimento"
                                           id="tx_relatorio_acolhimento"
                                           required
                                           placeholder="">
                                </div>
                                <div class="col s12">
                                    <input type="submit" value="Salvar" id="salvar" name="salvar"
                                           class="btn btn-success">
                                    <a href="{{route('triagem.index')}}" class="btn red">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function EventAlert() {
            swal("Cadastro efetuado com sucesso!", "success")
        }

        $(document).ready(function () {
            $('select').material_select();
        });
    </script>


@endsection
