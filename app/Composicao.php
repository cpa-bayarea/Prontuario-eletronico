<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composicao extends Model
{

    protected $table = 'tb_triagem_composicao';
    public $timestamps = true;
    protected $primaryKey = 'fk_triagem';
    protected $fillable = ['fk_triagem', 'fk_composicao_familiar'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['fk_triagem'])) {
            return $this::where('fk_triagem', $dados['fk_triagem'])->update($dados);
        }
        return $this::create($dados);
    }
}
