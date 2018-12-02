<?php

namespace App\Http\Controllers\Auth;

use App\SupervisorModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\PerfilModel as Perfil;
use App\LinhaTeoricaModel as Line;
use App\SupervisorModel as Supervisor;
use App\AlunoModel as Aluno;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
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

        return view('auth.register', compact(['perfis', 'lines', 'supervisors'] ,[$perfis, $lines, $supervisors]));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tx_name'                => ['required', 'string', 'max:255'],
            'tx_email'               => ['required', 'email', 'max:100', 'unique:users'],
            'username'               => ['required', 'max:11', 'unique:users'],
            'id_perfil'              => ['required', 'max:1'],
            'id_theoretical_line'    => ['max:1'],
            'nu_telephone'           => ['required', 'string', 'max:15'],
            'nu_cellphone'           => ['required', 'string', 'max:15'],
            'tx_justify'             => ['string', 'max:255'],
            'password'               => ['required', 'string', 'min:6', 'confirmed'],
            'nu_crp'                 => ['string', 'max:7'],
            'nu_semestre'            => ['string', 'max:2'],
        ]);
    }

    /**
     * Register a new user by returning the message on the form.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all());

        if( $request->id_perfil == User::PFL_SUPERVISOR ){

            $usernew = $this->createSupervisor($request);

        }elseif ($request->id_perfil == User::PFL_ALUNO){

            $usernew = $this->createAluno($request);
        }else{
            $usernew = $this->createOthers($request);
        }

        event(new Registered($user = $usernew));

        return redirect()->route('register')
            ->with(['registered' => 'Parabéns! Sua conta foi registrada com sucesso, a equipe de gestão do sistema irá avaliar suas credênciais.']);
    }

    /**
     * Cria um novo usuário caso o perfil dele seja supervisor.
     * @param Request $request
     * @return mixed
     * @since 01/12/2018
     */
    public function createSupervisor(Request $request)
    {
        $user = new User();

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->password     = Hash::make($request->password);

        $user->save();

        $usernew = User::where('username',$request->username)->first();

        $supervisor = new Supervisor();

        $supervisor->nu_crp              = $request->nu_crp;
        $supervisor->id_user             = $usernew->id;
        $supervisor->id_theoretical_line = $request->id_theoretical_line;

        $supervisor->save();

        return $usernew;
    }

    /**
     * Cria um novo usuário do perfil de aluno.
     * @param Request $request
     * @return mixed
     * @since 01/12/2018
     */
    public function createAluno(Request $request)
    {
        $user = new User();

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->password     = Hash::make($request->password);

        $user->save();

        $usernew = User::where('username', $request->username)->first();

        $aluno = new Aluno();

        $aluno->nu_half       = $request->nu_half;
        $aluno->id_user       = $usernew->id;
        $aluno->id_supervisor = $request->id_supervisor;

        $aluno->save();

        return $usernew;
    }

    /**
     * Cria um novo usuário caso o perfil dele não seja Aluno ou Supervisor
     * @param Request $request
     * @since 01/12/2018
     */
    public function createOthers(Request $request)
    {
        $user = new User();

        $user->tx_name      = $request->tx_name;
        $user->username     = $request->username;
        $user->id_perfil    = $request->id_perfil;
        $user->nu_telephone = $request->nu_telephone;
        $user->nu_cellphone = $request->nu_cellphone;
        $user->tx_justify   = $request->tx_justify;
        $user->tx_email     = $request->tx_email;
        $user->password     = Hash::make($request->password);

        $user->save();
    }
}
