<?php

namespace App\Http\Controllers;
use App\TriagemRenda;
use Illuminate\Http\Request;
use App\Http\Requests\TriagemRendaRequest;

class TriagemRendaController extends Controller
{
    public function form()
    {
        //Recebe dados do aluno

        //Envia variaveis para o form
        return view('TriagemRenda.form');
    }

    public function index()
    {
        //Recebe dados de TriagemRenda.
        $dados = TriagemRenda::all();
        //retorna variaveis com os dados para index
        return view('TriagemRenda.index', compact('dados'));

    }

    public function salvar(TriagemRendaRequest $dados)
    {
        if ($dados['fk_origem']) {
            //Se tiver dados altera e retorna para index
            TriagemRenda::find($dados['fk_origem'])->update($dados->all());
            return redirect(route('TriagemRenda.index'));
        } else {
            //salva dados e envia para index
            TriagemRenda::create($dados->all());
            return redirect(route('TriagemRenda.index'));
        }
    }


    public function alterar($id)
    {    //pega o id e envia os dados para form
        $dados = TriagemRenda::where('fk_origem', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('TriagemRenda.form', compact('dados'));
    }

    public function deletar($dados)
    {   //deleta dados
        TriagemRenda::where('fk_origem', $dados)->delete();
        return redirect(route('TriagemRenda.index'));
    }

}
