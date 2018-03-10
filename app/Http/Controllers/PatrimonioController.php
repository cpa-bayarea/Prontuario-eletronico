<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatrimonioRequest;
use App\Patrimonio;

class PatrimonioController extends Controller
{
    public function form()
    {
        $dados = Patrimonio:: all();
        return view('patrimonio.form', compact('dados'));
    }

    public function index()
    {
        $dados = Patrimonio::all();

        return view('patrimonio.index', compact('dados'));

    }

    public function salvar(PatrimonioRequest $dados)
    {
        if ($dados['id_patrimonio']) {
            Patrimonio::find($dados['id_patrimonio'])->update($dados->all());
            return redirect(route('patrimonio.index'));
        } else {
            Paci:ente:create($dados->all());
            return redirect(route('patrimonio.index'));
        }
    }


    public function alterar($id)
    {
        $dados = Patrimonio::where('id_patrimonio', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('patrimonio.form', compact('dados'));
    }

    public function deletar($dados)
    {
        Patrimonio::where('id_patrimonio', $dados)->delete();
        return redirect(route('patrimonio.index'));
    }
}
