<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_user')->insert([
            'id' => 1,
            'tipo' => 'adm',
        ]);   //
      DB::table('tipo_user')->insert([
            'id' => 2,
            'tipo' => 'supervisor',
        ]);   //
      DB::table('tipo_user')->insert([
            'id' => 3,
            'tipo' => 'aluno',
        ]);
    
        
        
      DB::table('users')->insert([
            'id' => 1,
            'name' => 'Luiz',
            'email' => 'luiz'.'@iesb.com',
            'password' => bcrypt('iesbiesb123'),
            'tipo_user_id' =>1 ,
        ]);   //
       //
        //
    }
}
