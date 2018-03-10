<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Http\Requests\GastoRequest;


class GastoController extends Controller
{
    public function index()
    {
        $dados = Gasto::all();

        return view('gasto.index', compact('dados'));
    }

    public function form()
    {
        $dados = Gasto::all();
        return view('gasto.form', compact('dados'));

    }
    public function alterar($id)
    {
        $dados = Gasto::where('id_gasto_saude', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('gasto.form', compact('dados'));
    }

    public function salvar(GastoRequest $dados)
    {
        if ($dados['id_gasto_saude']) {
            Gasto::find($dados['id_gasto_saude'])->update($dados->all());
            return redirect(route('gasto.index'));
        } else {
            Gasto::create($dados->all());
            return redirect(route('gasto.index'));
        }
    }

    public function deletar($dados)
    {
        Gasto::where('id_gasto_saude', $dados)->delete();
        return redirect(route('gasto.index'));
    }

}
