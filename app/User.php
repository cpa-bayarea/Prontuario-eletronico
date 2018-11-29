<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    # Constants of Perfi's
    const PFL_ADM        = 1;
    const PFL_ALUNO      = 2;
    const PFL_SUPERVISOR = 3;
    const PFL_SECRETARIA = 4;
    const PFL_TERAPEUTA  = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tx_name',
        'username',
        'id_perfil',
        'nu_telephone',
        'nu_cellphone',
        'tx_justify',
        'tx_email',
        'status',
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
