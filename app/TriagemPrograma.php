<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriagemPrograma extends Model
{
    protected $table = 'tb_triagem_programa_social';
    public $timestamps = true;
    protected $primaryKey = 'fk_programa_social';
    protected $fillable = ['fk_programa_social', 'fk_triagem'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['fk_programa_social'])) {
            return $this::where('fk_programa_social', $dados['fk_programa_social'])->update($dados);
        }
        return $this::create($dados);
    }
}
