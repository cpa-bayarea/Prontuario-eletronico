<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Executa as migrações da tabela Pacientes.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_paciente', function (Blueprint $table) {
            $table->increments('id_paciente');
            $table->string('tx_nome', 100);
            $table->date('dt_nascimento');
            $table->string('nu_celular', 15);
            $table->string('nu_telefone', 15)->nullable();
            $table->string('nu_cep', 15);
            $table->text('tx_endereco');
            $table->string('tx_email', 100);
            $table->enum('status', ['A', 'I'])->default('A');
        });
    }

    /**
     * Exclui as Migrações da tabela de Pacientes.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_paciente');
    }
}