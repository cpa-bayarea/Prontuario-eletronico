<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorModel extends Model
{
    protected $table = 'tb_supervisor';
    public $timestamps = FALSE;
    protected $primaryKey = 'id_supervisor';
    protected $fillable = [
        'nu_crp',
        'id_user',
        'id_theoretical_line',
    ];
}
