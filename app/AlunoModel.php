<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoModel extends Model
{
    protected $table = 'tb_aluno';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_aluno';
    protected $fillable = [
        'tx_nome',
        'nu_semestre',
        'nu_matricula',
        'nu_telefone',
        'nu_celular',
        'tx_email',
        'status',
        'id_supervisor',
    ];
}
