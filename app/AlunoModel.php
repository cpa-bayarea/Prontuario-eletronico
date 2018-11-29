<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoModel extends Model
{
    protected $table = 'tb_aluno';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_aluno';
    protected $fillable = [
        'nu_half',
        'id_user',
        'id_supervisor',
    ];
}
