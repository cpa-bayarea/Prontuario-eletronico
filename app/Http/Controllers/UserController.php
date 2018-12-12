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
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

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

            if ($request->id) {
                # Verifica se o status foi adicionado no formulário.
                $request->status = $request->status ? $request->status : 'I';

                $this->update($request);

                return redirect()->route('user.index')
                    ->with(['success' => 'Ação realizada com sucesso!']);
            }

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
        if(!\Gate::allows('Admin')){
            abort(403, "Página não autorizada! Você não tem permissão para acessar nessa página!");
        }

        $edit = User::where('id', $id)->first();

        if((int)$edit->id_perfil === User::PFL_SUPERVISOR){

            $user = User::query()
                ->select('users.id',
                                 'users.tx_name',
                                 'users.username',
                                 'pfl.id_perfil',
                                 'pfl.tx_name as perfil',
                                 'su.id_theoretical_line as linha_teorica',
                                 'lt.tx_name as lteorica',
                                 'users.nu_telephone',
                                 'users.nu_cellphone',
                                 'su.nu_crp',
                                 'users.tx_justify',
                                 'users.tx_email',
                                 'users.status',
                                 'users.created_at',
                                 'users.updated_at'
                )
                ->join('tb_supervisor as su', 'su.id_user', '=', 'users.id')
                ->join('tb_theoretical_line AS lt', 'lt.id_theoretical_line', '=', 'su.id_theoretical_line')
                ->join('tb_perfil AS pfl', 'pfl.id_perfil', '=', 'users.id_perfil')
                ->where('users.username' , '=', $edit->username)
                ->first();

            $lines = DB::table('tb_theoretical_line')
                ->where('status', '=', 'A')
                ->where('id_theoretical_line', '<>', $user->linha_teorica)
                ->orderBy('tx_name', 'asc')
                ->get();

            $perfis = DB::table('tb_perfil')
                ->where('status', '=', 'A')
                ->where('id_perfil', '<>', $user->id_perfil)
                ->orderBy('tx_name', 'asc')
                ->get();

            $checked = $user->status == 'A' ? 'checked="checked"' : '';

            return view('user.edit', compact(['perfis', 'lines', 'user', 'checked'], [$perfis, $lines, $user, $checked]));

        }elseif ((int)$edit->id_perfil === User::PFL_ALUNO){

            $user = User::query()
                ->select('users.id',
                                  'users.id AS id_user_aluno',
                                  'users.tx_name AS tx_name',
                                  'users.username',
                                  'users.nu_telephone AS nu_telephone',
                                  'users.nu_cellphone AS nu_cellphone',
                                  'users.tx_email AS tx_email',
                                  'users.status AS status',
                                  'users.tx_justify as tx_justify',
                                  'users.id_perfil',
                                  'pfl.tx_name as perfil',
                                  'al.nu_half AS nu_half',
                                  'usr_su.tx_name AS tx_nome_supervisor',
                                  'usr_su.id AS id_user_supervisor'
                )
                ->join('tb_aluno AS al', 'users.id', '=', 'al.id_user')
                ->join('tb_supervisor AS su', 'al.id_supervisor', '=', 'su.id_supervisor')
                ->join('users AS usr_su', 'su.id_user', '=', 'usr_su.id')
                ->join('tb_perfil AS pfl', 'pfl.id_perfil', '=', 'users.id_perfil')
                ->where('users.username' , '=', $edit->username)
                ->first();

            $checked = $user->status == 'A' ? 'checked="checked"' : '';

            $supervisors = DB::table('users as usr')
                ->select('usr.id as id_supervisor', 'usr.tx_name')
                ->join('tb_supervisor as sup', 'sup.id_user','=','usr.id')
                ->where('usr.status', '=', 'A')
                ->where('usr.id', '<>', $user->id_user_supervisor)
                ->orderBy('usr.tx_name', 'asc')
                ->get();

            return view('user.edit', compact(['supervisors', 'user', 'checked'], [$supervisors, $user, $checked]));

        }else{
            $user = $edit;

            $checked = $user->status == 'A' ? 'checked="checked"' : '';

            return view('user.edit', compact(['user', 'checked'], [$user, $checked]));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function update($request)
    {
        // Busca o registro do usuário passado via request.
        $user = User::where('id', $request->id)->first();

        if( (int)$user->id_perfil === User::PFL_ALUNO ){
            self::updateAluno($user, $request);

        }elseif ( (int)$user->id_perfil === User::PFL_SUPERVISOR ){
            self::updateSupervisor($user, $request);

        }else{
            self::updateOutros($user, $request);
        }

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

    /**
     * Atualiza o registro do Aluno informado no fomulário.
     *
     * @author Douglas <douglasantana007@gmail.com>
     * @since 10/12/2018
     * @param $user
     * @param $request
     */
    public static function updateAluno($user, $request)
    {

        $alu = Aluno::where('id_user', $user->id)->first();

        $sup = Super::where('id_user', $request->id_supervisor)->first();

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil ? $request->id_perfil : $user->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->status       = $request->status ? $request->status : 'A';

        $user->save();

        $alu->nu_half       = $request->nu_half;
        $alu->id_supervisor = (int)$sup->id_supervisor ? (int)$sup->id_supervisor : (int)$alu->id_supervisor;

        $alu->save();

    }


    /**
     * Atualiza o registro do Supervisor informado no fomulário.
     *
     * @author Douglas <douglasantana007@gmail.com>
     * @since 10/12/2018
     * @param $user
     * @param $request
     */
    public static function updateSupervisor($user, $request)
    {

        $super = Super::where('id_user', $user->id)->first();

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil ? $request->id_perfil : $user->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->status       = $request->status ? $request->status : 'A';
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $super->nu_crp              = $request->nu_crp;
        $super->id_theoretical_line = $request->id_theoretical_line ? $request->id_theoretical_line : $super->id_theoretical_line;

        $super->save();

    }

    /**
     * Atualiza o registro usuário comum informado no fomulário.
     *
     * @author Douglas <douglasantana007@gmail.com>
     * @since 10/12/2018
     * @param $user
     * @param $request
     */
    public static function updateOutros($user, $request)
    {

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil ? $request->id_perfil : $user->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->status       = $request->status;
        $user->password     = $request->password ? Hash::make($request->password) : $user->password;

        $user->save();
    }
}
