<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Http\Requests\PacienteRequest;
use App\Supervisor;
use App\Aluno;

class PacienteController extends Controller
{
    public function form()
    {
        //Recebe dados do supervisor
        $supervisores = Supervisor::all();
        //Recebe dados do aluno
        $alunos = Aluno:: all();

        //Envia variaveis para o form
        return view('paciente.form', compact('supervisores', 'alunos'));
    }

    public function index()
    {
        //Recebe dados de paciente.
        $dados = Paciente::all();
        //retorna variaveis com os dados para index
        return view('paciente.index', compact('dados'));

    }

    public function salvar(PacienteRequest $dados)
    {
        if ($dados['id_paciente']) {
            //Se tiver dados altera e retorna para index
            Paciente::find($dados['id_paciente'])->update($dados->all());
            return redirect(route('paciente.index'));
        } else {
            //salva dados e envia para index
            Paciente::create($dados->all());
            return redirect(route('paciente.index'));
        }
    }


    public function alterar($id)
    {    //pega o id e envia os dados para form
        $alunos = Aluno::all();
        $dados = Paciente::where('id_paciente', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('paciente.form', compact('dados','alunos'));
    }

    public function deletar($dados)
    {   //deleta dados
        Paciente::where('id_paciente', $dados)->delete();
        return redirect(route('paciente.index'));
    }

    public function aluno($id)
    {
        $aluno = Aluno::where('fk_supervisor', $id)->get()->first();
        return $aluno;
    }

    public function test()
    {
        return view('paciente.test');
    }

}