<?php

namespace App\Http\Controllers;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\ProjetoModel as Projeto;
use App\TipoProjetoModel as TipoProjeto;
use App\DemandantesModel as Demandante;
use Exception;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function index()
    {
        try {
            if(Auth()->user()->id_perfil == 1 || Auth()->user()->id_perfil == 2) {
                // Retorna todos os Projetos que tem o status Ativo.
                $projetos = Projeto::query()
                    ->select('tb_projeto.*', 'tb_demandante.nome as tx_nome_demandante', 'tb_tipo_projeto.nome as tx_nome')
                    ->join('tb_demandante', 'tb_demandante.id_demandante', '=', 'tb_projeto.id_demandante')
                    ->join('tb_tipo_projeto', 'tb_tipo_projeto.id_tipo_projeto', '=', 'tb_projeto.id_tipo_projeto')
                    ->where('tb_demandante.status', '=', 'A')
                    ->where('tb_tipo_projeto.status', '=', 'A')
                    ->orderBy('tb_projeto.nome', 'asc')
                    ->get();
            }

            if(Auth()->user()->id_perfil == 3){
                $projetos = Projeto::query()
                    ->select('tb_projeto.*', 'tb_demandante.nome as tx_nome_demandante', 'tb_tipo_projeto.nome as tx_nome')
                    ->join('tb_demandante', 'tb_demandante.id_demandante', '=', 'tb_projeto.id_demandante')
                    ->join('tb_tipo_projeto', 'tb_tipo_projeto.id_tipo_projeto', '=', 'tb_projeto.id_tipo_projeto')
                    ->where('tb_demandante.status', '=', 'A')
                    ->where('tb_tipo_projeto.status', '=', 'A')
                    ->where('tb_projeto.status', '=', 'A')
                    ->orderBy('tb_projeto.nome', 'asc')
                    ->get();
            }

            return view('projeto.index', compact('projetos', $projetos));
        } catch (\Exception $e) {
            throw new Exception('Não foi possível trazer os dados dos Tipos de projetos !');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminfate\Http\Response
     */
    public function create()
    {
        // Combo com todos os tipos de projetos para o form de Projeto.
        $tipo = TipoProjeto::all()->where('status', 'A');

        // Combo com todos os demandantes para o form de Projeto.
        $demandantes = Demandante::all()->where('status', 'A');

        return view('projeto.form', compact(['tipo', 'demandantes'], [$tipo,$demandantes]));
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
        try {
            if (!empty($request['id_projeto'])) {
                try {

                    # Remove os strings vindos do formulário de edição.
                    $request['valor'] = str_replace('.', '', $request['valor']);
                    $request['valor'] = str_replace(',', '.', $request['valor']);

                    Projeto::find($request['id_projeto'])->update($request->input());
                    return redirect()->route('projeto.index');
                } catch (Exception $e) {
                    throw new exception('Não foi possível alterar o registro do Projeto ' . $request->nome . ' !');
                }
            }
            $projetos = new Projeto();
            $projetos->nome            = $request->nome;

            # Remove os pontos e as virgulas do valor do projeto.
            $valor  = str_replace("." , "" , $request->valor);
            $valor2 = str_replace("," , "" , $valor);

            $projetos->valor           = $valor2;
            $projetos->dt_inicio       = $request->dt_inicio;
            $projetos->dt_fim          = $request->dt_fim;
            $projetos->id_tipo_projeto = $request->id_tipo_projeto;
            $projetos->id_demandante   = $request->id_demandante;
            $projetos->status          = $request->status ? $request->status : 'A';
            $projetos->save();

            return redirect()->route('projeto.index');
        } catch (Exception $e) {
            throw new exception('Não foi possível salvar o Projeto' . $request->nome . ' !');
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
        try {
            $projetos   = Projeto::find($id);
            $projetos->valor = number_format($projetos->valor, '2', ',', '.');

            # Retorna os registros de acordo com o Tipo de Projeto.
            $demandantes = Demandante::find($projetos->id_demandante);
            $tp_projeto  = TipoProjeto::find($projetos->id_tipo_projeto);

            $demandantes_all = Demandante::all();
            $tp_projeto_all  = TipoProjeto::all();

            return view('projeto.edit', compact(['projetos', 'demandantes', 'tp_projeto', 'demandantes_all', 'tp_projeto_all'],
                                                     [ $projetos,  $demandantes, $tp_projeto,   $demandantes_all,  $tp_projeto_all ]));

        } catch (Exception $e) {
            throw new exception('Não foi possível recuperar os dados do projeto ' . $projetos->nome . ' !');
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
        try {
            $projetos = Projeto::find($id);
            $projetos->status = 'I';
            $projetos->save();
            return redirect()->route('projeto.index');
        } catch (Exception $e) {
            throw new exception('Não foi possível excluir o registro do Projeto ' . $projetos->nome . ' !');
        }
    }
}
