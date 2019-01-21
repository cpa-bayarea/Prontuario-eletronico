<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinhaTeoricaModel extends Model
{
    protected $table = 'tb_linha_teorica';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_linha';
    protected $fillable = [
        'tx_nome',
        'tx_desc',
        'status',
    ];
}
