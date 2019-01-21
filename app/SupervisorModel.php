<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorModel extends Model
{
    protected $table = 'tb_supervisor';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_supervisor';
    protected $fillable = [
        'tx_nome',
        'nu_matricula',
        'nu_crp',
        'nu_telefone',
        'nu_celular',
        'tx_email',
        'status',
        'id_linha_teorica',
    ];
}
