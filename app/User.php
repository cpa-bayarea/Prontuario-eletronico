<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    # Constantes dos Perfi's
    const PFL_GESTOR     = 'Gestor';
    const PFL_ALUNO      = 'Aluno';
    const PFL_SUPERVISOR = 'Supervisor';
    const PFL_SECRETARIA = 'Secretaria';
    const PFL_TERAPEUTA  = 'Terapeuta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'status',
        'tx_perfil',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
