<?php

namespace App\Http\Controllers;
use App\Drogas;
use Illuminate\Http\DrogasRequest;

class DrogasController extends Controller
{
    public function form()
    {
;        $dados = Drogas::all();
        return view('drogas.form', compact('dados'));
    }

    public function index()
    {
        $dados = Drogas::all();

        return view('drogas.index', compact('dados'));

    }

    public function salvar(DrogasRequest $dados)
    {
        if ($dados['id_drogas']) {
            Drogas::find($dados['id_drogas'])->update($dados->all());
            return redirect(route('drogas.index'));
        } else {
            Drogas::create($dados->all());
            return redirect(route('drogas.index'));
        }
    }


    public function alterar($id)
    {
        $dados = Drogas::where('id_drogas', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('drogas.form', compact('dados'));
    }

    public function deletar($dados)
    {
        Drogas::where('id_drogas', $dados)->delete();
        return redirect(route('drogas.index'));
    }
}
