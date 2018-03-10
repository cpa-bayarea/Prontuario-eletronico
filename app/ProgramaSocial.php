<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaSocial extends Model
{
    protected $table = 'tb+programa_social';
    public $timestamps = true;
    protected $primaryKey = 'id_programa_social';
    protected $fillable = ['id_programa_social', 'tx_descricao'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_programa_social'])) {
            return $this::where('id_programa_social', $dados['id_programa_social'])->update($dados);
        }
        return $this::create($dados);
    }
}
