<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinhaTeoricaTable extends Migration
{
    /**
     * Executa as migrações da linha_teorica dos Supervisores.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_linha_teorica', function (Blueprint $table) {
            $table->increments('id_linha');
            $table->string('tx_nome', 70);
            $table->string('tx_desc', 100)->nullable();
            $table->enum('status', ['A', 'I'])->default('A');
        });
    }

    /**
     * Exclui as Migrações da tabela de linha teorica.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_linha_teorica');
    }
}
