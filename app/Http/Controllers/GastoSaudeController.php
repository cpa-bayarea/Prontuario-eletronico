<?php

namespace App\Http\Controllers;

use App\Http\Requests\GastoSaudeRequest;
use App\GastoSaude;
use App\Triagem;
use App\Gasto;
class GastoSaudeController extends Controller
{
    public function index()
    {
        $dados = GastoSaude::all();

        return view('gastoSaude.index', compact('dados', 'dados2'));
    }

    public function form()
    {
        $dados = Triagem::all();
        $dados2 = Gasto::all();

        return view('gastoSaude.form', compact('dados', 'dados2'));

    }
    public function alterar($id)
    {
        $dados = GastoSaude::where('fk_gasto_saude', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('gastoSaude.form', compact('dados'));
    }

    public function salvar(GastoSaudeRequest $dados)
    {
        if ($dados['fk_gasto_saude']) {
            GastoSaude::find($dados['fk_gasto_saude'])->update($dados->all());
            return redirect(route('gastoSaude.index'));
        } else {
            GastoSaude::create($dados->all());
            return redirect(route('gastoSaude.index'));
        }
    }

    public function deletar($dados)
    {
        GastoSaude::where('fk_gasto_saude', $dados)->delete();
        return redirect(route('gastoSaude.index'));
    }


}
