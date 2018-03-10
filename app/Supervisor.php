<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'tb_supervisor';
    public $timestamps = true;
    protected $primaryKey = 'id_supervisor';
    protected $fillable = ['nu_crp', 'tx_nome', 'nu_cep', 'tx_endereco', 'nu_numero', 'tx_bairro', 'tx_cidade',
        'tx_uf', 'nu_fone', 'nu_fone2', 'tx_email', 'nu_matricula', 'tx_observacao', 'dt_nascimento', 'created_at', 'updated_at'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_supervisor'])) {
            return $this::where('id_supervisor', $dados['id_supervisor'])->update($dados);
        }
        return $this::create($dados);
    }
}
