<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gastoSaude extends Model
{

    protected $table = 'tb_triagem_gasto_saude';
    public $timestamps = true;
    protected $primaryKey = 'fk_gastos_saude';
    protected $fillable = ['fk_gastos_saude', 'fk_triagem'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['fk_gastos_saude'])) {
            return $this::where('fk_gastos_saude', $dados['fk_gastos_saude'])->update($dados);
        }
        return $this::create($dados);
    }
}
