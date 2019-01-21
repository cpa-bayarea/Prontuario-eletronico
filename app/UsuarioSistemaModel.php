<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioSistemaModel extends Model
{
    protected $table = 'tb_usuario_sistema';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_usu_sis';
    protected $fillable = [
        'tx_nome',
        'nu_matricula',
        'nu_telefone',
        'nu_celular',
        'tx_email',
        'tx_cargo',
        'status',
    ];
}
