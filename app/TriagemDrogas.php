<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TriagemDrogas extends Model
{

    protected $table = 'tb_triagem_supervisor';
    public $timestamps = true;
    protected $primaryKey = 'fk_triagem';
    protected $fillable = ['fk_triagem', 'fk_drogas'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['fk_triagem'])) {
            return $this::where('fk_triagem', $dados['fk_triagem'])->update($dados);
        }
        return $this::create($dados);

    }
}