<?php

namespace App\Http\Controllers;
use App\Drogas;
use App\Triagem;
use App\TriagemDrogas;
use App\Http\Requests\triagemDrogasRequest;
class TriagemDrogasController extends Controller
{
    public function form()
    {
        $dados = Triagem::all();
        $dados2 = Drogas::all();
        return view('triagemDrogas.form', compact('dados', 'dados2'));
    }

    public function index()
    {
        $dados = TriagemDrogas::all();

        return view('triagemDrogas.index', compact('dados'));

    }

    public function salvar(triagemDrogasRequest $dados)
    {
        if ($dados['fk_doenca']) {
            TriagemDrogas::find($dados['fk_doenca'])->update($dados->all());
            return redirect(route('triagemDrogas.index'));
        } else {
            Paci:ente:create($dados->all());
            return redirect(route('triagemDrogas.index'));
        }
    }


    public function alterar($id)
    {
        $dados = TriagemDrogas::where('fk_doenca', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('triagemDrogas.form', compact('dados'));
    }

    public function deletar($dados)
    {
        TriagemDrogas::where('fk_doenca', $dados)->delete();
        return redirect(route('triagemDrogas.index'));
    }
}
