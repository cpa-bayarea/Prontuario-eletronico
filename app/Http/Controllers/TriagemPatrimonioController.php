<?php

namespace App\Http\Controllers;

use App\Http\Requests\TriagemPatrimonioRequest;
use App\TriagemPatrimonio;
use App\Triagem;

class TriagemPatrimonioController extends Controller
{
    public function index()
    {
        $dados = TriagemPatrimonio::all();

        return view('triagemPatrimonio.index', compact('dados', 'dados2'));
    }

    public function form()
    {
        $dados = Triagem::all();
        $dados2 = TriagemPatrimonio::all();

        return view('triagemPatrimonio.form', compact('dados', 'dados2'));

    }
    public function alterar($id)
    {
        $dados = TriagemPatrimonio::where('fk_gasto_saude', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('triagemPatrimonio.form', compact('dados'));
    }

    public function salvar(TriagemPatrimonioRequest $dados)
    {
        if ($dados['fk_gasto_saude']) {
            TriagemPatrimonio::find($dados['fk_gasto_saude'])->update($dados->all());
            return redirect(route('triagemPatrimonio.index'));
        } else {
            TriagemPatrimonio::create($dados->all());
            return redirect(route('triagemPatrimonio.index'));
        }
    }

    public function deletar($dados)
    {
        TriagemPatrimonio::where('fk_gasto_saude', $dados)->delete();
        return redirect(route('triagemPatrimonio.index'));
    }


}
