@extends('templates/principal')
@section('titulo', 'Cadastro de Supervisor')

@section('conteudo')

    <script type="text/javascript">
        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#tx_endereco").val("");
                $("#tx_bairro").val("");
                $("#tx_cidade").val("");
                $("#tx_uf").val("");
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

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/" + nu_cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#tx_endereco").val(dados.logradouro);
                                $("#tx_bairro").val(dados.bairro);
                                $("#tx_cidade").val(dados.localidade);
                                $("#tx_uf").val(dados.uf);
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
    <style>
        p.uppercase {
            text-transform: uppercase;
        }
    </style>
    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h4 class="grey-text" align="center">Cadastro de Supervisor</h4>
                    </div>
                    <form method="post" action={{route('supervisor.salvar')}}>
                        {{ csrf_field() }}
                        <div class="row">
                            <div id="oculto">
                                <input type="number" name="id_supervisor" id="id_supervisor"
                                       value="{{$dados['id_supervisor'] or null}}" hidden>
                            </div>
                            <div class="input-field col s12 l8">
                                <input id="tx_nome" name="tx_nome" type="text" class="validate" required
                                       value="{{$dados['tx_nome'] or null}}" maxlength="75">
                                <label for="tx_nome">Nome</label>
                            </div>
                            <div class="input-field col s3 l1">
                                <input type="text" id="nu_crp" name="nu_crp" class="validate" required
                                       value="{{$dados['nu_crp'] or null}}" maxlength="10">
                                <!-- CRP de acordo com o banco de dados -->
                                <label for="nu_crp">CRP</label>
                            </div>
                            <div class="input-field col s5 l3">
                                <input type="text" id="nu_matricula" name="nu_matricula" class="validate" required
                                       maxlength="11" value="{{$dados['nu_matricula'] or null}}">
                                <label for="nu_crp">Matrícula</label>
                            </div>
                            <div class="input-field col s4 l2">
                                <input type="text" maxlength="9" id="nu_cep" name="nu_cep" class="validate" required
                                       value="{{$dados['nu_cep'] or null}}">
                                <label for="nu_cep">CEP</label>
                            </div>
                            <div class="input-field col s12 l5">
                                <input type="text" id="tx_endereco" name="tx_endereco" class="validate" required
                                       value="{{$dados['tx_endereco'] or null}}" maxlength="45">
                                <label for="tx_endereco">Endereço</label>
                            </div>
                            <div class="input-field col s3 l1">
                                <input type="text" id="nu_numero" name="nu_numero" class="validate" required
                                       value="{{$dados['nu_numero'] or null}}" maxlength="5">
                                <!-- maxlength no banco é de 10, foi solicitado alteração-->
                                <label for="tx_endereco">Nº</label>
                            </div>
                            <div class="input-field col s9 l4">
                                <input type="text" id="tx_bairro" name="tx_bairro" class="validate" required
                                       value="{{$dados['tx_bairro'] or null}}" maxlength="45">
                                <label for="tx_bairro">Bairro</label>
                            </div>
                            <div class="input-field col s8 l3">
                                <input type="text" id="tx_cidade" name="tx_cidade" class="validate" required
                                       value="{{$dados['tx_cidade'] or null}}" maxlength="45">
                                <label for="tx_cidade">Cidade</label>
                            </div>
                            <div class="input-field col s4 l1">
                                <input type="text" id="tx_uf" maxlength="2" name="tx_uf" class="validate" required
                                       style="text-transform: uppercase" value="{{$dados['tx_uf'] or null}}">
                                <label for="tx_uf">UF</label>
                            </div>
                            <div class="input-field col s6 l2">
                                <input type="text" id="nu_fone" name="nu_fone" required class="validate"
                                       value="{{$dados['nu_fone'] or null}}" maxlength="15">
                                <label for="nu_fone">Telefone</label>
                            </div>
                            <div class="input-field col s6 l2">
                                <input type="text" id="nu_fone2" name="nu_fone2" class="validate"
                                       value="{{$dados['nu_fone2'] or null}}" maxlength="15">
                                <label for="nu_fone2">Celular</label>
                            </div>
                            <div class="input-field col s12 l4">
                                <input type="email" id="tx_email" name="tx_email" class="validate"
                                       value="{{$dados['tx_email'] or null}}" maxlength="45">
                                <label for="tx_email">E-mail</label>
                            </div>
                        </div>

                        <a href="{{route('supervisor.index')}}"> <input type="submit" value="Salvar" id="salvar"
                                                                        name="salvar" onclick="EventAlert()"
                                                                        class="btn btn-success"></a>


                        <a href="{{route('supervisor.index')}}" class="btn red">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
