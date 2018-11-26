<?php

namespace App\Http\Controllers;

use App\TipoProjetoModel;
use Illuminate\Http\Request;
use App\TipoProjetoModel as TpProjeto;
use Exception;

class TipoProjetosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            if(Auth()->user()->id_perfil == 1 || Auth()->user()->id_perfil == 2){
                // Retorna todos os Tipos de Projetos que tem o status Ativo.
                $tp_projetos = TpProjeto::orderBy('nome', 'asc')->get();
            }else

            // Retorna todos os Tipos de Projetos que tem o status Ativo.
            $tp_projetos = TpProjeto::where('status', 'A')->orderBy('nome', 'asc')->get();

            return view('tipo_projeto.index', compact('tp_projetos', $tp_projetos));
        } catch (\Exception $e) {
            throw new Exception('Não foi possível trazer os dados dos Tipos de projetos !');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        return view('tipo_projeto.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function store(Request $request)
    {
        if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {

            if (!empty($request['id_tipo_projeto'])) {
                try {
                    TpProjeto::find($request['id_tipo_projeto'])->update($request->input());
                    return redirect()->route('tipo_projeto.index');
                } catch (Exception $e) {
                    throw new exception('Não foi possível alterar o registro do Tipo de Projoto ' . $request->nome . ' !');
                }
            }
            $tp_projeto = new TpProjeto;
            $tp_projeto->nome = $request->nome;
            $tp_projeto->desc = $request->desc;
            $tp_projeto->status = 'A';
            $tp_projeto->save();

            return redirect()->route('tipo_projeto.index');
        } catch (Exception $e) {
            echo $e;
            throw new exception('Não foi possível salvar o Tipo de Projeto' . $request->nome . ' !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function edit($id)
    {
        if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $tp_projeto = TipoProjetoModel::find($id);
            return view('tipo_projeto.edit', compact('tp_projeto', $tp_projeto));

        } catch (Exception $e) {
            throw new exception('Não foi possível recuperar os dados do tipo de projeto ' . $tp_projeto->tx_nome . ' !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // está sendo feito no store.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $tp_projeto = TipoProjetoModel::find($id);
            $tp_projeto->status = 'I';
            $tp_projeto->save();
            return redirect()->route('tipo_projeto.index');
        } catch (Exception $e) {
            throw new exception('Não foi possível excluir o registro do Tipo de Projeto ' . $tp_projeto->tx_nome . ' !');
        }
    }
}
