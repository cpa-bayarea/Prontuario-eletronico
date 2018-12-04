<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('tx_name', 'asc')->get();

        foreach ($users as $user) {
            if ($user->id_perfil == User::PFL_ADM) {
                $user->id_perfil = 'Gestor';
            } elseif ($user->id_perfil == User::PFL_ALUNO) {
                $user->id_perfil = 'Aluno';
            } elseif ($user->id_perfil == User::PFL_SUPERVISOR) {
                $user->id_perfil = 'Supervisor';
            } elseif ($user->id_perfil == User::PFL_SECRETARIA) {
                $user->id_perfil = 'Secretária';
            } elseif ($user->id_perfil == User::PFL_TERAPEUTA) {
                $user->id_perfil = 'Terapeuta';
            }
        }

        return view('user.index', compact('users', $users));

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

        try {
            $perfis = DB::table('tb_perfil')
                ->where('status', 'A')
                ->orderBy('tx_name', 'asc')
                ->get();

            $lines = DB::table('tb_theoretical_line')
                ->where('status', 'A')
                ->orderBy('tx_name', 'asc')
                ->get();

            $supervisors = User::query()
                ->select('users.tx_name', 'sup.id_supervisor')
                ->join('tb_supervisor as sup', 'sup.id_user', '=', 'users.id')
                ->where('users.status', '=', 'A')
                ->orderBy('users.tx_name', 'asc')
                ->get();

            return view('user.form', compact(['perfis', 'lines', 'supervisors'], [$perfis, $lines, $supervisors]));

        } catch (\Exception $e) {
            throw new \exception('Não foi possível excluir o registro do ' . $user->tx_name . ' !');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            if((int)$request->id_perfil === User::PFL_ALUNO){
                $return = $this->validatorAluno($request->all());
dd($return);
                // if(){

                // }
            }elseif((int)$request->id_perfil === User::PFL_SUPERVISOR){
                $this->validatorSupervisor($request->all());
            }else{
                $this->validatorOthers($request->all());
            }

            dd($request);
            return view('user.form', compact(['perfis', 'lines', 'supervisors'], [$perfis, $lines, $supervisors]));

        } catch (\Exception $e) {
            echo $e;die;
            throw new \exception('Não foi possível adicionar o registro do ' . $request->tx_name . ' !');
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->first();
        dd($user);
        return view('user.edit', compact('user'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            $user = User::where('id', $id)->first();
            $user->status = 'I';
            $user->save();

            return redirect()->route('user.index');
        } catch (\Exception $e) {
            throw new \exception('Não foi possível excluir o registro do ' . $user->tx_name . ' !');
        }

    }

    /**
     * 
     */
    protected function validatorAluno($request)
    {
        echo '<pre>'; print_r($request); echo '</pre>';

        $name                  = $request['tx_name'] ? $request['tx_name'] : false;
        $username              = $request['username'] ? $request['username'] : false;
        $id_perfil             = $request['id_perfil'] ? $request['id_perfil'] : false;
        $nu_telephone          = $request['nu_telephone'] ? $request['nu_telephone'] : false;
        $nu_cellphone          = $request['nu_cellphone'] ? $request['nu_cellphone'] : NULL;
        $nu_half               = $request['nu_half'] ? $request['nu_half'] : false;
        $tx_justify            = $request['tx_justify'] ? $request['tx_justify'] : NULL;
        $id_supervisor         = $request['id_supervisor'] ? $request['id_supervisor'] : false;
        $tx_email              = $request['tx_email'] ? $request['tx_email'] : false;
        $password              = $request['password'] ? $request['password'] : false;
        $password_confirmation = $request['password_confirmation'] ? $request['password_confirmation'] : false;
        
        if( ((int)$password_confirmation) === ((int)$password) ) {
            if($name !== false){
                $return = 1;
            }elseif($username !== false){
                $return += 1;
            }elseif($id_perfil !== false){
                $return += 1;
            }elseif($nu_telephone !== false){
                $return += 1;
            }elseif($id_supervisor !== false){
                $return += 1;
            }elseif($tx_email !== false){
                $return += 1;
            }elseif($nu_half !== false){
                $return += 1;
            }

        }else{
            $return = 0;
        }

        return $return;
    }

    /**
     * 
     */
    protected function validatorSupervisor(array $data)
    {
        return Validator::make($data, [
            'tx_name'                => ['required', 'string', 'max:100'],
            'tx_email'               => ['required', 'email', 'max:100'],
            'username'               => ['required', 'max:11', 'unique:users'],
            'id_perfil'              => ['required', 'max:1'],
            'id_theoretical_line'    => ['required', 'max:1'],
            'nu_telephone'           => ['required', 'string', 'max:15'],
            'nu_cellphone'           => ['string', 'max:15'],
            'tx_justify'             => ['string', 'max:255'],
            'password'               => ['required', 'string', 'min:6', 'confirmed'],
            'nu_crp'                 => ['required', 'string', 'max:7'],
        ]);
    }

    /**
     * 
     */
    protected function validatorOthers(array $data)
    {
        return Validator::make($data, [
            'tx_name'                => ['required', 'string', 'max:255'],
            'tx_email'               => ['required', 'email', 'max:100', 'unique:users'],
            'username'               => ['required', 'max:11', 'unique:users'],
            'id_perfil'              => ['required', 'max:1'],
            'nu_telephone'           => ['required', 'string', 'max:15'],
            'nu_cellphone'           => ['required', 'string', 'max:15'],
            'tx_justify'             => ['string', 'max:255'],
            'password'               => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
}
