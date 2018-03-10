<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class familiar extends Model
{
    protected $table = 'tb_composicao_familiar';
    public $timestamps = true;
    protected $primaryKey = 'id_composicao_familiar';
    protected $fillable = ['id_composicao_familiar', 'tx_composicao'];
    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_composicao_familiar'])) {
            return $this::where('id_composicao_familiar', $dados['id_composicao_familiar'])->update($dados);
        }
        return $this::create($dados);
    }

}
