<?php

namespace App\Http\Controllers;

use App\SupervisorModel as Supervisor;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use App\AlunoModel as Aluno;
use App\User as User;
use Exception;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller

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
            $alunos = DB::table('tb_aluno as al')
                ->select('al.*', 'sup.tx_nome as nome_supervisor')
                ->join('tb_supervisor as sup', 'sup.id_supervisor', '=', 'al.id_supervisor')
                ->where('al.status', 'A')
                ->orderBy('al.tx_nome', 'asc')
                ->get();

            return view('aluno.index', compact('alunos', $alunos));
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

        $supervisores = Supervisor::where('status', 'A')->get();
        return view('aluno.form', compact('supervisores', $supervisores));
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
            if (!empty($request->id_perfil)) {
                try {
                    Aluno::find($request['id_perfil'])->update($request->input());
                    return redirect()->route('aluno.index');
                } catch (Exception $e) {
                    throw new exception('Não foi possível alterar o registro do Demandante ' . $request->nome . ' !');
                }
            }
            $aluno = new Aluno();
            $aluno->tx_nome       = $request->tx_nome;
            $aluno->nu_semestre   = $request->nu_semestre;
            $aluno->nu_matricula  = $request->nu_matricula;
            $aluno->nu_telefone   = $request->nu_telefone;
            $aluno->nu_celular    = $request->nu_celular;
            $aluno->tx_email      = $request->tx_email;
            $aluno->status        = $request->status;
            $aluno->id_supervisor = $request->id_supervisor;
            $aluno->status        = 'A';
            $aluno->save();

            $user = new User();
            $user->username  = $request->nu_matricula;
            $user->status    = 'A';
            $user->password  = bcrypt($request->tx_senha);
            $user->tx_perfil = 'Supervisor';
            $user->save();

            return redirect()->route('aluno.index');
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
            $aluno = Aluno::where('id_aluno', $id)->first();
            $supervisores = Supervisor::where('status', 'A')->get();
            return view('aluno.form', compact(['aluno', 'supervisores'], [$aluno, $supervisores]));

        } catch (Exception $e) {
            throw new exception('Não foi possível recuperar os dados do perfil ' . $aluno->tx_nome . ' !');
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
    public function destroy(Request $request)
    {
        if(!\Gate::allows('Gestor')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $aluno = Aluno::find($request->id_aluno);
            $aluno->status = 'I';
            $aluno->save();

            # Desativa o cadastro do Usuário na tabela principal.
            $user = User::where('username', $aluno->nu_matricula)->first();
            $user->status = 'I';
            $user->save();

            $response = array(
                'success' => 'success!'
            );
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
