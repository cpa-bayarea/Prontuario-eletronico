<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drogas extends Model
{
    protected $table = 'tb_drogas';
    public $timestamps = true;
    protected $primaryKey = 'id_drogas';
    protected $fillable = ['id_drogas', 'tx_nome'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_drogas'])) {
            return $this::where('id_drogas', $dados['id_drogas'])->update($dados);
        }
        return $this::create($dados);
    }
}
