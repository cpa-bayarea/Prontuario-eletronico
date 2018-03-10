<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriagemPatrimonio extends Model
{
    protected $table = 'tb_triagem_patrimonio';
    public $timestamps = true;
    protected $primaryKey = 'fk_patrimonio';
    protected $fillable = ['fk_patrimonio','fk_triagem'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['fk_patrimonio'])) {
            return $this::where('fk_patrimonio', $dados['fk_patrimonio'])->update($dados);
        }
        return $this::create($dados);
    }

}
