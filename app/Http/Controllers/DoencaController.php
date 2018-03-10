<?php

namespace App\Http\Controllers;

use App\Doenca;
use App\Http\Requests\DoencaRequest;

class DoencaController extends Controller
{
    public function index()
    {
        $dados = Doenca::all();

        return view('Doenca.index', compact('dados'));
    }

    public function form()
    {
        return view('Doenca.form');

    }
    public function alterar($id)
    {
        $dados = Doenca::where('id_doenca_cronica', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('Doenca.form', compact('dados'));
    }

    public function salvar(DoencaRequest $dados)
    {
        if ($dados['id_doenca_cronica']) {
            Doenca::find($dados['id_doenca_cronica'])->update($dados->all());
            return redirect(route('Doenca.index'));
        } else {
            Doenca::create($dados->all());
            return redirect(route('Doenca.index'));
        }
    }

    public function deletar($dados)
    {
        Doenca::where('id_doenca_cronica', $dados)->delete();
        return redirect(route('Doenca.index'));
    }

}
