<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gasto extends Model
{
    protected $table = 'tb_gasto_saude';
    public $timestamps = true;
    protected $primaryKey = 'id_gasto_saude';
    protected $fillable = ['id_gasto_saude', 'tx_gasto_saude'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_gasto_saude'])) {
            return $this::where('id_gasto_saude', $dados['id_gasto_saude'])->update($dados);
        }
        return $this::create($dados);
    }
    }
