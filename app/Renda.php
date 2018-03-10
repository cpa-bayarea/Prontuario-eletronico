<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class renda extends Model
{

    protected $table = 'tb_origem_renda';
    public $timestamps = true;
    protected $primaryKey = 'id_origem_renda';
    protected $fillable = ['id_origem_renda', 'tx_origem'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_origem_renda'])) {
            return $this::where('id_origem_renda', $dados['id_origem_renda'])->update($dados);
        }
        return $this::create($dados);
    }
}
