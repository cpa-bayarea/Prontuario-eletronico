<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorTable extends Migration
{
    /**
     * Executa as migrações da tabela Supervisor.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_supervisor', function (Blueprint $table) {
            $table->increments('id_supervisor');
            $table->string('tx_nome', 100);
            $table->string('nu_matricula', 15);
            $table->string('nu_crp', 7);
            $table->string('nu_telefone', 15)->nullable();
            $table->string('nu_celular', 15);
            $table->string('tx_email', 100);
            $table->enum('status', ['A', 'I'])->default('A');

            $table->integer('id_linha_teorica')->unsigned();
            $table->foreign('id_linha_teorica')->references('id_linha')->on('tb_linha_teorica');
        });
    }

    /**
     * Exclui as Migrações da tabela de Supervisor.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_supervisor');
    }
}