<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinhaTeoricaModel as Linha;
use App\User as Perfil;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LinhaTeoricaController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if(!\Gate::allows('Admin')){
                abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
            }

            # Order case user is adm.
            if(Auth()->user()->id_perfil === Perfil::PFL_ADM){
                $linhas = DB::table('tb_theoretical_line')
                    ->orderBy('tx_name', 'asc')
                    ->get();

                return view('linha_teorica.index', compact('linhas', $linhas));
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }
        return view('linha_teorica.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \exception
     */
    public function store(Request $request)
    {
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }
        try{
            # Verifica o status da Linha teorica.
            $request->status = $request->status ? $request->status : 'I';
            if (!empty($request['id_theoretical_line'])) {
                try {
                    # Procura pela linha teórica.
                    $linha = Linha::find($request['id_theoretical_line']);

                    $linha->tx_name = $request->tx_name;
                    $linha->tx_desc = $request->tx_desc;
                    $linha->status = $request->status;
                    $linha->save();

                    return redirect()->route('linha.index');
                } catch (\Exception $e) {
                    throw new exception('Não foi possível alterar o registro da Linha Teórica ' . $request->nome . ' !');
                }
            }
            $linha = new Linha();
            $linha->tx_name = $request->tx_name;
            $linha->tx_desc = $request->tx_desc;
            $linha->status = 'A';
            $linha->save();
            return redirect()->route('linha.index');
        } catch (\Exception $e ){
            throw new \exception('Não foi possível salvar a Linha Teórica '.$request->nome.' !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }
        $linha = Linha::find($id);
        $checked = ($linha->status == "A") ? 'checked' : '';

        return view('linha_teorica.edit', compact(['linha', 'checked'], [$linha, $checked]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \exception
     */
    public function destroy($id)
    {
         if(!\Gate::allows('Admin')){
             abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
         }
        try{
            $linha = Linha::find($id);
            $linha->status = 'I';
            $linha->save();
            return redirect()->route('linha.index');
        } catch(\Exception $e){
            throw new \exception('Não foi possível excluir o registro da Linha Teórica '.$linha->tx_nome.' !');
        }
    }
}
