<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    protected $table = 'tb_patrimonio';
    public $timestamps = true;
    protected $primaryKey = 'id_patrimonio';
    protected $fillable = ['id_patrimonio', 'tx_descricao'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_patrimonio'])) {
            return $this::where('id_patrimonio', $dados['id_patrimonio'])->update($dados);
        }
        return $this::create($dados);
    }
}
