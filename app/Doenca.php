<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doenca extends Model
{

    protected $table = 'tb_doenca_cronica';
    public $timestamps = true;
    protected $primaryKey = 'id_doenca_cronica';
    protected $fillable = ['id_doenca_cronica', 'tx_nome'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_doenca_cronica'])) {
            return $this::where('id_doenca_cronica', $dados['id_doenca_cronica'])->update($dados);
        }
        return $this::create($dados);
    }
}
