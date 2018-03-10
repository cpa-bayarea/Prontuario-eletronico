<?php

namespace App\Http\Controllers;

use App\Dados;
use App\Http\Requests\DoencaRequest;

class DadosController extends Controller
{
    public function index()
    {
        $dados = Dados::all();

        return view('composicao.index', compact('dados'));
    }

    public function form()
    {
        return view('composicao.form');

    }
    public function alterar($id)
    {
        $dados = Dados::where('fk_triagem', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('composicao.form', compact('dados'));
    }

    public function salvar(DoencaRequest $dados)
    {
        if ($dados['fk_triagem']) {
            Dados::find($dados['fk_triagem'])->update($dados->all());
            return redirect(route('Dados.index'));
        } else {
            Dados::create($dados->all());
            return redirect(route('Dados.index'));
        }
    }

    public function deletar($dados)
    {
        Dados::where('fk_triagem', $dados)->delete();
        return redirect(route('Dados.index'));
    }

}
