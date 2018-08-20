# Versionamento do Prontuário

## Ambientes

No projeto temos 2 ambientes; 
* O ambiente de produção, contido na Branch `Master`, versão mais estável do projeto.
* O ambiente local, utilizado para realização das demandas e para testes.

## Branch's Principais

* `Master` - Produto final, contida na url: 
* `Develop` - Contém as demandas feitas, ou seja, novas funcionalidades demandadas pelo cliente.
* `Homologa` - Contém as demandas que serão homologadas pelo cliente.


## Requisitos

Clone o Projeto.

> git clone https://github.com/cpa-bayarea/Prontuario-eletronico.git

Siga os passos abaixo.


## Criando uma branch a partir da branch Master
Para iniciar sua contribuição, tire sua branch da `master`.

```bash
    $ git fetch
    $ git checkout master
    $ git pull origin master
    $ git checkout -b seuNome-nomeDemanda

    Eg: $ git checkout -b douglas-documento-versionamento
    Obs: Evitar letras maiúsculas na criação da branch, para evitar qualquer tipo de problemas e para padronização do sistema.
```

## Submeta suas Modificações ao Remoto

```bash
    $ git add docs/Versionamento.md
    $ git commit -m"[ADD] Adicionado Documento de Versionamento."
    $ git push origin suabranch

```
Após finalizar a sua demanda e fazer o seu teste local, submeta sua branch a `Develop` e peça que um outro dev a teste.

```bash
   $ git checkout Develop
   $ git pull origin Develop
   $ git merge suaBranch
   $ git push origin Develop

```

## Teste do Demandante

Após a equipe testar cada nova funcionalidade, evitando o máximo possível de erros e bugs, chega a hora do cliente fazer o
teste dele e verificar se a funcionalidade ficoun como o mesmo havia solicitado. 
<br> As publicações a serem testadas pelo cliente deverão ser contidas na branch `Homologa`. Segue os passos para a publicação.

> Solicite o PR de sua branch [aqui](https://github.com/cpa-bayarea/Prontuario-eletronico/pulls), Mandando para a branch `Homologa`
> Adicione um <b>Revisor</b> no Pull Request, <b>nunca aceite um PR criado por você mesmo</b>.


#### Caso de Aprovação do Cliente

Após o cliente aprovar a demanda, siga os passos na parte de publicação em produção.


#### Caso de Não Aprovação do Cliente

Caso o Cliente não tenha gostado de algo produzido, faça as devidas alterações e repita o fluxo até a aprovação dele.

## Publicação em Produção

> Solicite o PR de sua branch [aqui](https://github.com/cpa-bayarea/Prontuario-eletronico/pulls), Mandando para a branch `master`
> Adicione um <b>Revisor</b> no Pull Request, <b>nunca aceite um PR criado por você mesmo</b>.


