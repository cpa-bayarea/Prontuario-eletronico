<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Http\Requests\doencaCronicaRequest;
use App\Triagem;
use App\Doenca;

class DoencaCronicaController extends Controller
{
    public function form()
    {
        $dados2 = Doenca::all();
        $dados = Triagem::all();
        return view('doencaCronica.form', compact('dados', 'dados2'));
    }

    public function index()
    {
        $dados = Doenca::all();

        return view('doencaCronica.index', compact('dados'));

    }

    public function salvar(doencaCronicaRequest $dados)
    {
        if ($dados['fk_triagem']) {
            Paciente::find($dados['fk_triagem'])->update($dados->all());
            return redirect(route('doencaCronica.index'));
        } else {
            Paciente::create($dados->all());
            return redirect(route('doencaCronica.index'));
        }
    }


    public function alterar($id)
    {
        $dados = Paciente::where('fk_triagem', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('doencaCronica.form', compact('dados'));
    }

    public function deletar($dados)
    {
        Paciente::where('fk_triagem', $dados)->delete();
        return redirect(route('doencaCronica.index'));
    }

}