<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinhaTeoricaModel extends Model
{
    protected $table = 'tb_theoretical_line';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_theoretical_line';
    protected $fillable = [
        'tx_nome',
        'tx_desc',
        'status',
    ];
}
