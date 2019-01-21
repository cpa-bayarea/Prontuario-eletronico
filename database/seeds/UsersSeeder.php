<?php

use Illuminate\Database\Seeder;
use App\User;
use \App\SupervisorModel as Supervisor;
use \App\AlunoModel as Aluno;
use \App\UsuarioSistemaModel as UsuSis;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'  => '123',
            'status'    => 'A',
            'tx_perfil' => 'Gestor',
            'password'     => bcrypt(123123),
        ]);

        UsuSis::create([
            'tx_nome'     => 'Douglas Santana Fontes',
            'nu_matricula' => '123',
            'nu_telefone' => '12345678',
            'nu_celular' => '12345678',
            'tx_email' => 'd@d.com',
            'tx_cargo' => 'Gestor',
            'status' => 'A',
        ]);

        User::create([
            'username'  => '1234',
            'status'    => 'A',
            'tx_perfil' => 'Gestor',
            'password'     => bcrypt(123123),
        ]);

        UsuSis::create([
            'tx_nome'     => 'Patrícia Santos',
            'nu_matricula' => '1234',
            'nu_telefone' => '12345678',
            'nu_celular' => '12345678',
            'tx_email' => 'p@p.com',
            'tx_cargo' => 'Gestor',
            'status' => 'A',
        ]);

        User::create([
            'username'  => '333',
            'status'    => 'A',
            'tx_perfil' => 'Secretaria',
            'password'     => bcrypt(123123),
        ]);

        UsuSis::create([
            'tx_nome'     => 'Secretária do sistema',
            'nu_matricula' => '333',
            'nu_telefone' => '12345678',
            'nu_celular' => '12345678',
            'tx_email' => 's@s.com',
            'tx_cargo' => 'Secretaria',
            'status' => 'A',
        ]);

        User::create([
            'username'  => '444',
            'status'    => 'A',
            'tx_perfil' => 'Supervisor',
            'password'     => bcrypt(123123),
        ]);

        Supervisor::create([
            'tx_nome' => 'Supervisor do sistema',
            'nu_matricula' => '444',
            'nu_crp' => '12354',
            'nu_telefone' => '12345632',
            'nu_celular'  => '02313120',
            'tx_email'  => 'sup@sup.com',
            'status' => 'A',
            'id_linha_teorica' => 1,
        ]);

        User::create([
            'username'  => '222',
            'status'    => 'A',
            'tx_perfil' => 'Aluno',
            'password'     => bcrypt(123123),
        ]);

        Aluno::create([
            'tx_nome'       => 'West Aluno',
            'nu_semestre'   => '10',
            'nu_matricula'  => '222',
            'nu_telefone'   => '0123',
            'nu_celular'    => '0123',
            'tx_email'      => 'al@al.com',
            'status'        => 'A',
            'id_supervisor' => 1,
        ]);

        User::create([
            'username'  => '555',
            'status'    => 'A',
            'tx_perfil' => 'Terapeuta',
            'password'     => bcrypt(123123),
        ]);

        UsuSis::create([
            'tx_nome'     => 'Terapeuta do sistema',
            'nu_matricula' => '555',
            'nu_telefone' => '12345678',
            'nu_celular' => '12345678',
            'tx_email' => 't@t.com',
            'tx_cargo' => 'Terapeuta',
            'status' => 'A',
        ]);
    }
}


/**
 * SELECT
usr.id AS id_user_aluno,
usr.tx_name AS tx_nome_aluno,
usr.username AS nu_matricula_aluno,
usr.nu_telephone AS nu_telefone_aluno,
usr.nu_cellphone AS nu_celular_aluno,
usr.tx_email AS tx_email_aluno,
usr.status AS tp_status_aluno,
usr_su.tx_name AS tx_nome_supervisor,
usr_su.id AS id_user_supervisor,
usr_su.username AS nu_matricula_supervisor,
usr_su.nu_telephone AS nu_telefone_supervisor,
usr_su.nu_cellphone AS nu_celular_supervisor,
usr_su.tx_email AS tx_email_supervisor,
usr_su.status AS tp_status_supervisor
FROM users AS usr
JOIN tb_aluno AS al ON (usr.id = al.id_user)
JOIN tb_supervisor AS su ON (al.id_supervisor = su.id_supervisor)
JOIN users AS usr_su ON (su.id_user = usr_su.id);



-- get all the informations of supervisors.



select
us.id,
us.tx_name,
us.tx_email,
us.username,
us.nu_telephone,
us.nu_cellphone,
us.tx_justify,
us.status,
su.nu_crp,
concat(su.id_theoretical_line, ' - ', lt.tx_name) as linha_teorica
from tb_supervisor AS su
JOIN users AS us ON (us.id = su.id_user)
JOIN tb_theoretical_line AS lt ON (lt.id_theoretical_line = su.id_theoretical_line)
ORDER BY
1;

select * from users;
 *
 */