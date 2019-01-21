<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosSistemaTable extends Migration
{
    /**
     * Executa as migrações da tabela Usuarios do Sistema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario_sistema', function (Blueprint $table) {
            $table->increments('id_usu_sis');
            $table->string('tx_nome', 100);
            $table->string('nu_matricula', 15);
            $table->string('nu_telefone', 15)->nullable();
            $table->string('nu_celular', 15);
            $table->string('tx_email', 100);
            $table->text('tx_cargo');
            $table->enum('status', ['A', 'I'])->default('A');
        });
    }

    /**
     * Exclui as Migrações da tabela de Usuarios do Sistema.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_usuario_sistema');
    }
}