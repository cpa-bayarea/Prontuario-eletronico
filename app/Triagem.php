<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    protected $table = 'tb_triagem';
    public $timestamps = false;
    protected $primaryKey = 'id_triagem';
    protected $fillable = ['id_triagem', 'fk_paciente', 'fk_aluno', 'fk_supervisor', 'tp_grupo', 'tx_queixa', 'tx_observacao',
        'tp_necessidade_atendi', 'tp_visto_supervisor', 'tp_recusa', 'tx_motivo_recusa', 'dt_recusa',
        'tx_responsavel', 'tx_patrimonio', 'tp_familia_estuda', 'nu_mensalidade',
        'nu_qtd_pessoa', 'nu_qtd_trabalha', 'tp_deficiencia',
        'tx_deficiencia', 'tp_acompanhamento_psic',
        'tp_acompanhamento', 'tx_local_acompanhamento',
        'tp_drogas', 'tx_relatorio_acolhimento', 'fk_paciente', 'fk_aluno', 'fk_supervisor'];


    public function salvar($dados)
    {
        $dados = upperVar($dados);
        if (!empty($dados['id_triagem'])) {
            return $this::where('id_triagem', $dados['id_triagem'])->update($dados);
        }
        return $this::create($dados);
    }
}
