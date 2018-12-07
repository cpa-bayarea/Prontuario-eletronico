<?php

namespace App\Http\Controllers;

use App\AlunoModel as Aluno;
use App\PerfilModel as PFL;
use App\SupervisorModel as Super;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
     * @throws \exception
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
            throw new \exception('Não foi possível atender a sua solicitação! ');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \exception
     */
    public function store(Request $request)
    { 
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        try {
            if((int)$request->id_perfil === User::PFL_ALUNO){
                $error = $this->validatorAluno($request->all());
                if($error >= 1){
                    return redirect()->back();
                }else{
                    $user = new User();

                    $user->tx_name      = $request->tx_name;
                    $user->tx_email     = $request->tx_email;
                    $user->username     = $request->username;
                    $user->nu_telephone = $request->nu_telephone;
                    $user->nu_cellphone = $request->nu_cellphone;
                    $user->tx_justify   = $request->tx_justify;
                    $user->id_perfil    = $request->id_perfil;
                    $user->password     = Hash::make($request->password);

                    $user->save();

                    $al = User::where('username', $request->username)->first();

                    $aluno = new Aluno();

                    $aluno->nu_half = $request->nu_half;
                    $aluno->id_user = $al->id;
                    $aluno->id_supervisor = $request->id_supervisor;

                    $aluno->save();

                    return $this->index();
                }

            }elseif((int)$request->id_perfil === User::PFL_SUPERVISOR){
                $error = $this->validatorSupervisor($request->all());
                if($error >= 1){
                    return redirect()->back();
                }else {
                    $user = new User();

                    $user->tx_name      = $request->tx_name;
                    $user->tx_email     = $request->tx_email;
                    $user->username     = $request->username;
                    $user->nu_telephone = $request->nu_telephone;
                    $user->nu_cellphone = $request->nu_cellphone;
                    $user->tx_justify   = $request->tx_justify;
                    $user->id_perfil    = $request->id_perfil;
                    $user->password     = Hash::make($request->password);

                    $user->save();

                    $sup = User::where('username', $request->username)->first();

                    $supervisor = new Super();

                    $supervisor->nu_crp              = $request->nu_crp;
                    $supervisor->id_user             = $sup->id;
                    $supervisor->id_theoretical_line = $request->id_theoretical_line;

                    $supervisor->save();

                    return $this->index();
                }
            }else{
                $this->validatorOthers($request->all());
            }

            return view('user.index');

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
        $user = User::where('id', $id)->first();

        $user = User::query()
            ->select('')
        ;


        if((int)$user->id_perfil === User::PFL_SUPERVISOR){
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

            $perfis = PFL::where('status','=', 'A')->get();

            $perfil = User::query()
                ->select('pfl.tx_name', 'pfl.id_perfil')
                ->join('tb_perfil as pfl', 'pfl.id_perfil', '=', 'users.id_perfil')
                ->where('users.id', '=', $user->id)
                ->orderBy('users.tx_name', 'asc')
                ->get();

            return view('user.edit', compact(['user', 'perfil', 'perfis','lines', 'supervisors'], [$perfil, $perfis , $user, $lines, $supervisors]));
        }

        echo 234;die;
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
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \exception
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
     * Check if the $request is valid, verifying data size and mandatory.
     *
     * @param $request => Data of user form.
     * @since 05/12/2018
     * @return bool
     */
    protected function validatorAluno($request)
    {
        $return = 0;
        $name                  = $request['tx_name'] ? $request['tx_name'] : '';
        $username              = $request['username'] ? $request['username'] : '';
        $id_perfil             = $request['id_perfil'] ? $request['id_perfil'] : '';
        $nu_telephone          = $request['nu_telephone'] ? $request['nu_telephone'] : '';
        $nu_cellphone          = $request['nu_cellphone'] ? $request['nu_cellphone'] : NULL;
        $nu_half               = $request['nu_half'] ? $request['nu_half'] : '';
        $tx_justify            = $request['tx_justify'] ? $request['tx_justify'] : NULL;
        $id_supervisor         = $request['id_supervisor'] ? $request['id_supervisor'] : '';
        $tx_email              = $request['tx_email'] ? $request['tx_email'] : '';
        $password              = $request['password'] ? $request['password'] : '';
        $password_confirmation = $request['password_confirmation'] ? $request['password_confirmation'] : '';

        if( ((int)$password_confirmation) === ((int)$password) ) {

            if( (strlen($name) > 100) || ( !($name == null) && ($name == '') ) ){
                $return += 1;
            }elseif( (strlen($username) > 11) || ( !($username == null)  && ($username == '') )){
                $return += 1;
            }elseif( ($id_perfil == null) || ($id_perfil == '') ){
                $return += 1;
            }elseif( (strlen($nu_telephone) > 11) || ( !($nu_telephone == null) && ($nu_telephone == '') )){
                $return += 1;
            }elseif( (strlen($nu_cellphone) > 11) ){
                $return += 1;
            }elseif( ($id_supervisor == null) || ($id_supervisor == '') ){
                $return += 1;
            }elseif( (strlen($tx_email) > 100) || ( !($tx_email == null) && ($tx_email == '') )){
                $return += 1;
            }elseif( (strlen($nu_half) > 2) || ( !($nu_half == null) && ($nu_half == '') )){
                $return += 1;
            }
        }else{
            $return = 1;
        }

        return (int)$return;
    }

    /**
     * Check if the $request is valid, verifying data size and mandatory.
     *
     * @param $request => Data of user form.
     * @since 06/12/2018
     * @return bool
     */
    protected function validatorSupervisor($request)
    {
        $return = 0;
        $name                  = $request['tx_name'] ? $request['tx_name'] : '';
        $username              = $request['username'] ? $request['username'] : '';
        $id_perfil             = $request['id_perfil'] ? $request['id_perfil'] : '';
        $nu_telephone          = $request['nu_telephone'] ? $request['nu_telephone'] : '';
        $nu_cellphone          = $request['nu_cellphone'] ? $request['nu_cellphone'] : NULL;
        $id_theoretical_line   = $request['id_theoretical_line'] ? $request['id_theoretical_line'] : '';
        $nu_crp                = $request['nu_crp'] ? $request['nu_crp'] : '';
        $tx_justify            = $request['tx_justify'] ? $request['tx_justify'] : NULL;
        $tx_email              = $request['tx_email'] ? $request['tx_email'] : '';
        $password              = $request['password'] ? $request['password'] : '';
        $password_confirmation = $request['password_confirmation'] ? $request['password_confirmation'] : '';

        if( ((int)$password_confirmation) === ((int)$password) ) {

            if( (strlen($name) > 100) || ( !($name == null) && ($name == '') ) ){
                $return += 1;
            }elseif( (strlen($username) > 11) || ( !($username == null)  && ($username == '') )){
                $return += 1;
            }elseif( ($id_perfil == null) || ($id_perfil == '') ){
                $return += 1;
            }elseif( (strlen($nu_telephone) > 11) || ( !($nu_telephone == null) && ($nu_telephone == '') )){
                $return += 1;
            }elseif( (strlen($nu_cellphone) > 11) ){
                $return += 1;
            }elseif( ($id_theoretical_line == null) || ($id_theoretical_line == '') ){
                $return += 1;
            }elseif( (strlen($tx_email) > 100) || ( !($tx_email == null) && ($tx_email == '') )){
                $return += 1;
            }elseif( (strlen($nu_crp) > 7) || ( !($nu_crp == null) && ($nu_crp == '') )){
                $return += 1;
            }
        }else{
            $return = 1;
        }

        return (int)$return;
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
