<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoTable extends Migration
{
    /**
     * Executa as migrações da tabela Aluno.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aluno', function (Blueprint $table) {
            $table->increments('id_aluno');
            $table->string('tx_nome', 100);
            $table->string('nu_semestre', 2);
            $table->string('nu_matricula', 15);
            $table->string('nu_telefone', 15)->nullable();
            $table->string('nu_celular', 15);
            $table->string('tx_email', 100);
            $table->enum('status', ['A', 'I'])->default('A');

            $table->integer('id_supervisor')->unsigned();
            $table->foreign('id_supervisor')->references('id_supervisor')->on('tb_supervisor');
        });
    }

    /**
     * Exclui as Migrações da tabela de Alunos.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aluno');
    }
}