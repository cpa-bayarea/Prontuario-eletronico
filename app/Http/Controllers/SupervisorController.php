<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Http\Requests\SupervisorRequest;
use App\Supervisor;

class SupervisorController extends Controller
{
    public function index()
    {
        $dados = Supervisor::all();

        return view('supervisor.index', compact('dados'));
    }

    public function form()
    {
        $dados = Supervisor::all();
        return view('supervisor.form', compact('dados'));
    }

    public function alterar($id)
    {
        $dados = Supervisor::where('id_supervisor', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('supervisor.form', compact('dados'));
    }


    public function salvar(SupervisorRequest $dados)
    {
        if ($dados['id_supervisor']) {
            Supervisor::find($dados['id_supervisor'])->update($dados->all());
            return redirect(route('supervisor.index'));
        } else {
            Supervisor::create($dados->all());
            return redirect(route('supervisor.index'));

        }

    }
    public function deletar($dados)
    {
        Supervisor::where('id_supervisor', $dados)->delete();
        return redirect(route('supervisor.index'));
    }
}