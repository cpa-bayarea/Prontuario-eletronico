<?php

namespace App\Http\Controllers;

use App\Composicao;
use App\Http\Requests\ComposicaoRequest;

class ComposicaoController extends Controller
{
    public function index()
    {
        $dados = Composicao::all();

        return view('composicao.index', compact('dados'));
    }

    public function form()
    {
        return view('composicao.form');

    }
    public function alterar($id)
    {
        $dados = Composicao::where('fk_triagem', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('composicao.form', compact('dados'));
    }

    public function salvar(ComposicaoRequest $dados)
    {
        if ($dados['fk_triagem']) {
            Composicao::find($dados['fk_triagem'])->update($dados->all());
            return redirect(route('Composicao.index'));
        } else {
            Composicao::create($dados->all());
            return redirect(route('Composicao.index'));
        }
    }

    public function deletar($dados)
    {
        Composicao::where('fk_triagem', $dados)->delete();
        return redirect(route('Composicao.index'));
    }

}
