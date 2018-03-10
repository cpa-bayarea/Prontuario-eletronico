<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renda;
use App\Http\Requests\RendaRequest;

class rendaController extends Controller
{

    public function form()
    {
        //Recebe dados do aluno

        //Envia variaveis para o form
        return view('Renda.form');
    }

    public function index()
    {
        //Recebe dados de Renda.
        $dados = Renda::all();
        //retorna variaveis com os dados para index
        return view('Renda.index', compact('dados'));

    }

    public function salvar(RendaRequest $dados)
    {
        if ($dados['id_origem_renda']) {
            //Se tiver dados altera e retorna para index
            Renda::find($dados['id_origem_renda'])->update($dados->all());
            return redirect(route('Renda.index'));
        } else {
            //salva dados e envia para index
            Renda::create($dados->all());
            return redirect(route('Renda.index'));
        }
    }


    public function alterar($id)
    {    //pega o id e envia os dados para form
        $dados = Renda::where('id_origem_renda', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('Renda.form', compact('dados'));
    }

    public function deletar($dados)
    {   //deleta dados
        Renda::where('id_origem_renda', $dados)->delete();
        return redirect(route('Renda.index'));
    }
}
