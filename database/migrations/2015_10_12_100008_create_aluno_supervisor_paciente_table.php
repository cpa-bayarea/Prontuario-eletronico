<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoSupervisorPacienteTable extends Migration
{
    /**
     * Executa as migrações da tabela Aluno Supervisor Paciente.
     *
     * OBS: Tabela com finalidade para gerenciar quais alunos e supervisores podem gerenciar os pacientes.
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aluno_supervisor_paciente', function (Blueprint $table) {
            $table->increments('id_alsupac');
            $table->enum('status', ['A', 'I'])->default('A');

            $table->integer('id_paciente')->unsigned();
            $table->foreign('id_paciente')->references('id_paciente')->on('tb_paciente');

            $table->integer('id_aluno')->unsigned();
            $table->foreign('id_aluno')->references('id_aluno')->on('tb_aluno');

            $table->integer('id_supervisor')->unsigned();
            $table->foreign('id_supervisor')->references('id_supervisor')->on('tb_supervisor');

            $table->integer('id_usu_sis')->unsigned()->nullable();
            $table->foreign('id_usu_sis')->references('id_usu_sis')->on('tb_usuario_sistema');
        });
    }

    /**
     * Exclui as Migrações da tabela de Aluno Supervisor Paciente.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_aluno_supervisor_paciente');
    }
}