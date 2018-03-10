<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramaSocial;
use App\Http\Requests\ProgramaSocialRequest;

class ProgramaSocialController extends Controller
{
    public function form()
    {
        //Envia variaveis para o form
        return view('programaSocial.form');
    }

    public function index()
    {
        //Recebe dados de programaSocial.
        $dados = ProgramaSocial::all();
        //retorna variaveis com os dados para index
        return view('programaSocial.index', compact('dados'));

    }

    public function salvar(ProgramaSocialRequest $dados)
    {
        if ($dados['id_programa_social']) {
            //Se tiver dados altera e retorna para index
            ProgramaSocial::find($dados['id_programa_social'])->update($dados->all());
            return redirect(route('programaSocial.index'));
        } else {
            //salva dados e envia para index
            ProgramaSocial::create($dados->all());
            return redirect(route('programaSocial.index'));
        }
    }


    public function alterar($id)
    {    //pega o id e envia os dados para form
        $dados = ProgramaSocial::where('id_programa_social', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('programaSocial.form', compact('dados'));
    }

    public function deletar($dados)
    {   //deleta dados
        ProgramaSocial::where('id_programa_social', $dados)->delete();
        return redirect(route('programaSocial.index'));
    }

}
