# Pré Requisitos

Segue lista com os pré-requisitos para rodar o projeto em sua máquina.

* [Composer](https://getcomposer.org/download/)
* [Git](https://git-scm.com/downloads)
* [Variáveis de Ambiente](https://laravel.com/docs/5.6#installation)
* [Laravel](https://laravel.com/docs/5.7#installation)

## Instalação

### Ambiente Linux:

* Git
Para instalar o Git, basta executar o comando abaixo;

> sudo apt install git 

Ao instalar, configure seu git com os comandos abaixo;

> git config --global user.name 'seuNome'
Para testar se funcionou, basta executar `git config --global user.name`

> git config --global user.email 'seuEmailDoGitHub'
Para testar se funcionou, basta executar `git config --global user.email`

### Ambiente Windows:

* Composer
Ao entrar no site do [Composer](https://getcomposer.org/download/), basta clicar no link após o 'Donwload and run'. Ao baixar, instale o compose em sua máquina

* Git
Ao entrar no site do [Git](https://git-scm.com/downloads), basta clicar no link que será exibido num monitor de computador 'Donwload 2.18.0 for Windows'.
Ao instalar, configure seu git com os comandos abaixo;

> git config --global user.name 'seuNome'
Para testar se funcionou, basta executar `git config --global user.name`

> git config --global user.email 'seuEmailDoGitHub'
Para testar se funcionou, basta executar `git config --global user.email`

* Variáveis de Ambiente
Para levantar o servidor do apache, que o próprio Laravel vem embutido, é requirido que tenha habilitado algumas extensões em seu arquivo php.
Confira na documentação oficial e faça em sua máquina.

* Laravel

Via terminal, execute o seguinte comando para installar o laravel;

> composer global require "laravel/installer"

Após finalizado, teste criando um projeto novo.

> laravel new teste

# Testando

Após seguir todos os passos citados acima, seu ambiente estará apto a rodar o projeto, execute os comandos abaixo para confirmação de sucesso na instalação.

> composer

> git 

> laravel new teste 


