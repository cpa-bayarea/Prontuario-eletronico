<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TriagemProgramaRequest;
use App\TriagemPrograma;

class TriagemProgramaController extends Controller
{
    public function form()
    {
        //Envia variaveis para o form
        return view('paciente.form');
    }

    public function index()
    {
        //Recebe dados de paciente.
        $dados = TriagemPrograma::all();
        //retorna variaveis com os dados para index
        return view('paciente.index', compact('dados'));

    }

    public function salvar(TriagemProgramaRequest $dados)
    {
        if ($dados['fk_programa_social']) {
            //Se tiver dados altera e retorna para index
            TriagemPrograma::find($dados['fk_programa_social'])->update($dados->all());
            return redirect(route('paciente.index'));
        } else {
            //salva dados e envia para index
            TriagemPrograma::create($dados->all());
            return redirect(route('paciente.index'));
        }
    }


    public function alterar($id)
    {    //pega o id e envia os dados para form
        $dados = TriagemPrograma::where('fk_programa_social', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('paciente.form', compact('dados'));
    }

    public function deletar($dados)
    {   //deleta dados
        TriagemPrograma::where('fk_programa_social', $dados)->delete();
        return redirect(route('paciente.index'));
    }

}
