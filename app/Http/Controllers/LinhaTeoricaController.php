<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinhaTeoricaModel as Linha;

class LinhaTeoricaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $linhas = Linha::where('status', 'A')->orderBy('tx_name', 'asc')->get();
        $linhas = Linha::all();

        return view('linha_teorica.index', compact('linhas', $linhas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('linha_teorica.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            // if(!empty($request['id_theoretical_line'])){
            //     try{
            //         Linha::find($request['id_theoretical_line'])->update($request->input());
            //         return redirect()->route('linha.index');
            //     } catch(Exception $e){
            //         throw new exception('Não foi possível alterar o registro da Linha Teórica '.$request->nome.' !');
            //     }
            // }
            $linha = new Linha();
            $linha->tx_name = $request->tx_name;
            $linha->tx_desc = $request->tx_desc;
            $linha->status = 'A';
            $linha->save();
            return redirect()->route('linha.index');
        } catch (Exception $e ){
            echo $e;
            throw new exception('Não foi possível salvar a Linha Teórica'.$request->nome.' !');
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
        //
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
     */
    public function destroy($id)
    {
        // if(!\Gate::allows('Admin') && !\Gate::allows('Geren')){
        //     abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        // }
        try{
            $linha = Linha::find($id);
            $linha->status = 'I';
            $linha->save();
            return redirect()->route('linha.index');
        } catch(Exception $e){
            throw new exception('Não foi possível excluir o registro da Linha Teórica '.$linha->tx_nome.' !');
        }
    }
}
