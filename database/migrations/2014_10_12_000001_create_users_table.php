<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_users');
            $table->string('tx_nome', 100);
            $table->string('tx_email', 100);
            $table->string('username', 11)->unique(); // Matrícula
            $table->text('tx_justificativa')->nullable();
            $table->string('tp_perfil', 20)->nullable();
            $table->char('status', 1)->default('P'); // opções => [A, I, P] Activo, Inativo or Pendente
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

