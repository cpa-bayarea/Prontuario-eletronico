<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'tb_paciente';
    public $timestamps = true;
    protected $primaryKey = 'id_paciente';
    protected $fillable = ['id_paciente', 'tx_nome', 'tx_nome_responsavel',
        'dt_nascimento', 'tx_endereco', 'nu_numero', 'tx_uf'
        , 'tx_bairro', 'tx_cidade', 'nu_cpf', 'nu_rg', 'tx_orgao_expe', 'tx_uf_orgao'
        , 'tx_naturalidade', 'tx_uf_naturalidade', 'nu_fone', 'nu_fone1'
        , 'tx_estado_civil', 'tx_sexo', 'tx_raca', 'tp_atendimento'
        , 'tp_orientacao_sexual', 'tp_entrada_encam', 'tp_saida_encam'
        , 'fk_aluno', 'fk_supervisor', 'created_at', 'updated_at'];

    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_paciente'])) {
            return $this::where('id_paciente', $dados['id_paciente'])->update($dados);
        }
        return $this::create($dados);
    }

}
