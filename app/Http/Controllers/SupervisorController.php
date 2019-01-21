<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use App\SupervisorModel as Supervisor;
use App\LinhaTeoricaModel as Linha;
use Exception;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            # Retorna todos os Supervisores que tem o status Ativo.
            $supervisores = Supervisor::query()
                ->select('tb_supervisor.*', 'lte.tx_nome as nome_linha')
                ->join('tb_linha_teorica as lte', 'lte.id_linha', '=', 'tb_supervisor.id_linha_teorica')
                ->where('tb_supervisor.status', '=', 'A')
                ->where('lte.status', '=', 'A')
                ->orderBy('tb_supervisor.tx_nome', 'asc')
                ->get();

            return view('supervisor.index', compact('supervisores', $supervisores));
        } catch (\Exception $e) {
            throw new Exception('Não foi possível trazer os dados dos Supervisors !');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminfate\Http\Response
     */
    public function create()
    {
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        return view('perfil.form');
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
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }
        try {
            if (!empty($request['id_perfil'])) {
                try {
                    Perfil::find($request['id_perfil'])->update($request->input());
                    return redirect()->route('supervisor.index');
                } catch (Exception $e) {
                    throw new exception('Não foi possível alterar o registro do Demandante ' . $request->nome . ' !');
                }
            }
            $supervisor = new Perfil();
            $supervisor->nome = $request->nome;
            $supervisor->status = 'A';
            $supervisor->save();

            return redirect()->route('supervisor.index');
        } catch (Exception $e) {
            throw new exception('Não foi possível salvar o Perfil' . $request->nome . ' !');
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
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $supervisor = Supervisor::query()
                ->select('tb_supervisor.*', 'lte.tx_nome as nome_linha')
                ->join('tb_linha_teorica as lte', 'lte.id_linha', '=', 'tb_supervisor.id_linha_teorica')
                ->where('tb_supervisor.id_supervisor', '=', $id)
                ->where('tb_supervisor.status', '=', 'A')
                ->where('lte.status', '=', 'A')
                ->orderBy('tb_supervisor.tx_nome', 'asc')
                ->get();
            $linhas = Linha::where('status', 'A')->get();

            return view('supervisor.edit', compact(['supervisor', 'linhas'], [$supervisor, $linhas]));

        } catch (Exception $e) {
            echo $e;die;
            throw new exception('Não foi possível recuperar os dados do perfil ' . $supervisor[0]['tx_nome'] . ' !');
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
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $supervisor = Perfil::find($id);
            $supervisor->status = 'I';
            $supervisor->save();
            return redirect()->route('supervisor.index');
        } catch (Exception $e) {
            throw new exception('Não foi possível excluir o registro do Perfil ' . $supervisor->tx_nome . ' !');
        }
    }
}
