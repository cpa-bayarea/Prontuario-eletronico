<?php

namespace App\Http\Controllers;

use App\Triagem;
use App\Http\Requests\TriagemRequest;
use App\Supervisor;
use App\Aluno;
use App\Paciente;

class TriagemController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dados = Triagem::all();

        return view('triagem.index', compact('dados'));
    }

    public function form($id)  // BUGADA AQUI !!!!!
    {
        $paciente = Paciente::find($id);
      //  dd($paciente);
        $aluno = Aluno::find($paciente->fk_aluno);
     //   dd($aluno);
        $supervisor = Supervisor::find($aluno->fk_supervisor);
        //dd($supervisor);
        return view('triagem.form', compact('paciente', 'aluno', 'supervisor'));
    }

    public function alterar($id)
    {
        $dados = Triagem::where('id_triagem', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('triagem.form', compact('dados'));
    }

    public function salvar(TriagemRequest $dados)
    {
        if ($dados['id_triagem']) {
            Triagem::find($dados['id_triagem'])->update($dados->all());
            return redirect(route('triagem.index'));
        } else {
            Triagem::create($dados->all());
            return redirect(route('triagem.index'));
        }
    }

    public function deletar($dados)
    {
        Triagem::where('id_triagem', $dados)->delete();
        return redirect(route('triagem.index'));
    }

}

