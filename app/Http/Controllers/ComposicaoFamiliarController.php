<?php

namespace App\Http\Controllers;
use App\ComposicaoFamiliar;
use App\Http\Requests\ComposicaoFamiliarRequest;

class ComposicaoFamiliarController extends Controller
{
    public function index()
    {
        $dados = ComposicaoFamiliar::all();

        return view('composicaoFamiliar.index', compact('dados'));
    }

    public function form()
    {
        return view('composicaoFamiliar.form');

    }
    public function alterar($id)
    {
        $dados = ComposicaoFamiliar::where('id_composicao_familiar', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('composicaoFamiliar.form', compact('dados'));
    }

    public function salvar(ComposicaoFamiliarRequest $dados)
    {
        if ($dados['id_composicao_familiar']) {
            ComposicaoFamiliar::find($dados['id_composicao_familiar'])->update($dados->all());
            return redirect(route('ComposicaoFamiliar.index'));
        } else {
            ComposicaoFamiliar::create($dados->all());
            return redirect(route('ComposicaoFamiliar.index'));
        }
    }

    public function deletar($dados)
    {
        ComposicaoFamiliar::where('id_composicao_familiar', $dados)->delete();
        return redirect(route('ComposicaoFamiliar.index'));
    }
}
