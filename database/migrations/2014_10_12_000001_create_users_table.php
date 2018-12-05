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
            $table->increments('id');
            $table->string('tx_name', 100);
            $table->string('tx_email', 100);
            $table->string('username', 11)->unique();
            $table->string('nu_telephone', 15)->nullable();
            $table->string('nu_cellphone', 15)->nullable();
            $table->text('tx_justify')->nullable();
            $table->char('status', 1)->default('P'); // options => [A, I, P] Active, Inative or Pending

            $table->integer('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('tb_perfil');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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

