<?php

namespace App\Http\Controllers;

use App\Familiar;
use App\Http\Requests\FamiliarRequest;

use Illuminate\Http\Request;
class FamiliarController extends Controller
{
    public function index()
    {
        $dados = Familiar::all();

        return view('familiar.index', compact('dados'));
    }

    public function form()
    {
        $dados = Familiar::all();
        return view('familiar.form', compact('dados'));
    }

    public function alterar($id)
    {
        $dados = Familiar::where('id_composicao_familiar', $id)->get();
        $dados = $dados[0];
//            print_r($dados);
//            die;
        return view('familiar.form', compact('dados'));
    }


    public function salvar(FamiliarRequest $dados)
    {
        if ($dados['id_composicao_familiar']) {
            Familiar::find($dados['id_composicao_familiar'])->update($dados->all());
            return redirect(route('familiar.index'));
        } else {
            Familiar::create($dados->all());
            return redirect(route('familiar.index'));

        }

    }


    public function deletar($dados)
    {
        Familiar::where('id_composicao_familiar', $dados)->delete();
        return redirect(route('familiar.index'));
    }
}
