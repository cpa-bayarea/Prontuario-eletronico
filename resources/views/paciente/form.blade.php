@extends('templates/principal')
@section('titulo', 'Cadastro de Paciente')
@section('conteudo')

    <script type="text/javascript">
        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#tx_endereco").val("");
                $("#tx_bairro").val("");
                $("#tx_cidade").val("");
                $("#tx_uf").val("");
                //   $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#nu_cep").blur(function () {

                //Nova variável "cep" somente com dígitos.
                var nu_cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (nu_cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(nu_cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#tx_endereco").val("...");
                        $("#tx_bairro").val("...");
                        $("#tx_cidade").val("...");
                        $("#tx_uf").val("...");
                        //    $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/" + nu_cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#tx_endereco").val(dados.logradouro);
                                $("#tx_bairro").val(dados.bairro);
                                $("#tx_cidade").val(dados.localidade);
                                $("#tx_uf").val(dados.uf);
                                //      $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                swal("CEP não encontrado !", '', 'error');
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        swal("Formato de CEP inválido !");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Cadastro de paciente</h4>
                    </div>
                    <form method="post" action={{route('paciente.salvar')}}>
                        {{ csrf_field() }}
                        <div id="oculto">
                            <input type="number" name="id_supervisor" id="id_supervisor"
                                   value="{{$dados['id_supervisor'] or null}}" hidden>
                        </div>
                        <div class="input-field col s12 l3">
                            <input type="text" id="tx_nome" value="{{$dados['tx_nome'] or null}}" name="tx_nome"
                                   required class="validate"/>
                            <label for="tx_nome" class="">Nome</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="nu_cpf" name="nu_cpf" value="{{$dados['nu_cpf'] or null}}" required
                                   class="validate"/>
                            <label for="nu_cpf">CPF</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="nu_rg" name="nu_rg" value="{{$dados['nu_rg'] or null}}" required
                                   class="validate"/>
                            <label for="nu_rg">RG</label>
                        </div>
                        <div class="input-field col s7 l3">
                            <input type="text" id="tx_naturalidade" name="tx_naturalidade"
                                   value="{{$dados['tx_naturalidade'] or null}}" required class="validate"/>
                            <label for="email">Naturalidade</label>
                        </div>
                        <div class="input-field col s5 l3">
                            <input type="text" id="tx_uf_naturalidade" name="tx_uf_naturalidade"
                                   value="{{$dados['tx_uf_naturalidade'] or null}}" required
                                   style="text-transform: uppercase" class="validate" maxlength="2"/>
                            <label for="tx_uf_naturalidade">UF naturalidade</label>
                        </div>
                        <div class="input-field col s7 l3">
                            <input type="text" id="tx_orgao_expe" name="tx_orgao_expe"
                                   value="{{$dados['tx_orgao_expe'] or null}}" required class="validate" maxlength="3"
                                   style="text-transform: uppercase">
                            <label for="orgao">Orgão expedidor</label>
                        </div>
                        <div class="input-field col s5 l3">
                            <input type="text" id="tx_uf_orgao" name="tx_uf_orgao"
                                   value="{{$dados['tx_uf_orgao'] or null}}" required class="validate" maxlength="2"
                                   style="text-transform: uppercase"/>
                            <label for="tx_uf_orgao">UF orgão</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="tx_nome_responsavel" name="tx_nome_responsavel"
                                   value="{{$dados['tx__nome_responsavel'] or null}}" required
                                   class="validate"/>
                            <label for="tx_nome_responsavel">Responsável</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="tx_parentesco" name="tx_parentesco"
                                   value="{{$dados['tx_parentesco'] or null}}" required class="validate"/>
                            <label for="tx_parentesco">Parentesco</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="dt_nascimento" name="dt_nascimento"
                                   value="{{$dados['dt_nascimento'] or null}}" required class="datepicker">
                            <label for="dt_nascimento">Nascimento</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="nu_fone" name="nu_fone" value="{{$dados['nu_fone'] or null}}"
                                   required
                                   class="validate"/>
                            <label for="nu_fone">Telefone</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="nu_fone1" name="nu_fone1" value="{{$dados['nu_fone1'] or null}}"
                                   class="">
                            <label for="nu_fone1">Celular</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input name="nu_cep" type="text" id="nu_cep" value="{{$dados['nu_cep'] or null}}" size="10"
                                   maxlength="9"
                                   class="validate"
                                   onblur="pesquisacep(this.value);"/>
                            <label for="nu_cep">CEP</label>
                        </div>
                        <div class="input-field col s9 l3">
                            <input type="text" id="tx_endereco" name="tx_endereco"
                                   value="{{$dados['tx_endereco'] or null}}" required
                                   class="validate"/>
                            <label for="tx_endereco">Endereço</label>
                        </div>
                        <div class="input-field col s3 l3">
                            <input type="text" id="nu_numero" name="nu_numero" value="{{$dados['nu_numero'] or null}}"
                                   required class="validate" maxlength="4"/>
                            <label for="numero">Nº</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="tx_bairro" name="tx_bairro" value="{{$dados['tx_bairro'] or null}}"
                                   required class="validate"/>
                            <label for="tx_bairro">Bairro</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <input type="text" id="tx_cidade" name="tx_cidade" value="{{$dados['tx_cidade'] or null}}"
                                   required
                                   class="validate"/>
                            <label for="tx_cidade">Cidade</label>
                        </div>
                        <div class="input-field col s2 l3">
                            <input type="text" id="tx_uf" name="tx_uf" value="{{$dados['tx_uf'] or null}}" required
                                   class="validate" style="text-transform: uppercase" maxlength="2"/>
                            <label for="tx_uf">UF</label>
                        </div>
                        <div class="input-field col s10 l3">
                            <select name="tp_atendimento">
                                <option value="">selecione</option>
                                <option value="{{$dados['tp_atendimento'] or 'C'}}">Criança</option>
                                <option value="{{$dados['tp_atendimento'] or 'D'}}">Adolescente</option>
                                <option value="{{$dados['tp_atendimento'] or 'A'}}">Adulto</option>
                                <option value="{{$dados['tp_atendimento'] or 'I'}}">Idoso</option>
                            </select>
                            <label>Tipo de atendimento</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <select name="tp_orientacao_sexual">
                                <option value="">selecione</option>
                                <option value="{{$dados['tp_orientacao_sexual'] or 'H'}}">Homossexual</option>
                                <option value="{{$dados['tp_orientacao_sexual'] or 'T'}}">Heterossexual</option>
                                <option value="{{$dados['tp_orientacao_sexual'] or 'A'}}">Assexual</option>
                                <option value="{{$dados['tp_orientacao_sexual'] or 'B'}}">Bissexual</option>
                            </select>
                            <label>Orientação sexual</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <select name="tx_sexo">
                                <option value="">Selecione</option>
                                <option value="{{$dados['tx_sexo'] or 'M'}}">Masculino</option>
                                <option value="{{$dados['tx_sexo'] or 'F'}}">Feminino</option>
                            </select>
                            <label>Sexo</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <select name="tx_raca">
                                <option value="">selecione</option>
                                <option value="{{$dados['tx_raca'] or 'N'}}">Negro</option>
                                <option value="{{$dados['tx_raca'] or 'B'}}">Branco</option>
                                <option value="{{$dados['tx_raca'] or 'P'}}">Pardo(a)</option>
                                <option value="{{$dados['tx_raca'] or 'I'}}">Indio</option>
                            </select>
                            <label>Raça</label>
                        </div>
                        <div class="input-field col s6 l3">
                            <select name="tx_estado_civil">
                                <option value="">selecione</option>
                                <option value="{{$dados['tx_estado_civil'] or 'C'}}">Casado(a)</option>
                                <option value="{{$dados['tx_estado_civil'] or 'D'}}">Divorciado(a)</option>
                                <option value="{{$dados['tx_estado_civil'] or 'S'}}">Solteiro(a)</option>
                                <option value="{{$dados['tx_estado_civil'] or 'U'}}">União Estável</option>
                                <option value="{{$dados['tx_estado_civil'] or 'V'}}">Viúvo(a)</option>
                            </select>
                            <label name="tx_estado_civil">Estado Civil</label>
                        </div>
                        <div class="input-field col s12 l3">
                            <select name="fk_aluno">
                                @foreach($alunos as $aluno)
                                    <option value="{{$aluno['id_aluno']}}">{{$aluno['tx_nome']}}</option>
                                @endforeach
                            </select>
                            <label name="fk_aluno">Aluno</label>
                        </div>
                        <!--   <a href="#" onclick="Novo"><i
                                       class="material-icons left red-text">delete</i></a> -->
                      <a href="{{route('paciente.index')}}">  <input  type="submit" value="Salvar" id="Salvar" align="" name="salvar" onclick="Novo" class="btn btn-success"></a>
                               
                        <a href="{{route('paciente.index')}}" class="btn red">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        function Novo() {
            swal('Cadastro efetuado com sucesso !', 'success') //Exibe o alerta ao confirmar o cadastro
        }

        $(document).ready(function () {
            $('select').material_select();
        });

        $(function () {
            $('#fk_supervisor').change(function () {
                console.log('mudando');
                $.get('/paciente/aluno/' + $('#fk_supervisor').val(), function (data) {
                    console.log(data);
                })
            })

        })

        // INICIALIZAÇÃO DA DATA DE NASCIMENTO DO PACIENTE
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });
    </script>
@endsection