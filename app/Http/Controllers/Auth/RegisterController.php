<?php

namespace App\Http\Controllers\Auth;

use App\SupervisorModel;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\PerfilModel as Perfil;
use App\LinhaTeoricaModel as Line;
use App\SupervisorModel as Supervisor;


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
        $perfis = Perfil::all()->where('status', 'A');
        $lines  = Line::all()->where('status', 'A');

        return view('auth.register', compact(['perfis', 'lines'] ,[$perfis, $lines]));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
    //     echo 'validator';
    //    dd($data);
        return Validator::make($data, [
            'tx_name'                => ['required', 'string', 'max:255'],
            'tx_email'               => ['required', 'string', 'email', 'max:100', 'unique:users'],
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if ($data['id_perfil'] == User::PFL_SUPERVISOR) {

            $user =
                User::create([
                    'tx_name'      => $data['tx_name'],
                    'username'     => $data['username'],
                    'id_perfil'    => $data['id_perfil'],
                    'nu_telephone' => $data['nu_telephone'],
                    'nu_cellphone' => $data['nu_cellphone'],
                    'tx_justify'   => $data['tx_justify'],
                    'password'     => bcrypt($data['password']),
                    'tx_email'     => $data['tx_email'],
            ]);
            Supervisor::create([
                'id_user'             => $user->id_user,
                'id_theoretical_line' => $data['id_theoretical_line'],
                'nu_crp'              => $data['nu_crp'],
            ]);
            return $user;

        }elseif ($data['id_perfil'] == User::PFL_ALUNO){

            $user = User::create([
                        'tx_name'             => $data['tx_name'],
                        'username'            => $data['username'],
                        'id_perfil'           => $data['id_perfil'],
                        'nu_telephone'        => $data['nu_telephone'],
                        'nu_cellphone'        => $data['nu_cellphone'],
                        'tx_justify'          => $data['tx_justify'],
                        'tx_email'            => $data['tx_email'],
                        'password'            => Hash::make($data['password']),
            ]);
        }else{
            return User::create([
                'tx_name'             => $data['tx_name'],
                'username'            => $data['username'],
                'id_perfil'           => $data['id_perfil'],
                'nu_telephone'        => $data['nu_telephone'],
                'nu_cellphone'        => $data['nu_cellphone'],
                'tx_justify'          => $data['tx_justify'],
                'tx_email'            => $data['tx_email'],
                'password'            => Hash::make($data['password']),
            ]);
        }
    }

    /**
     * Register a new user by returning the message on the form.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        //    dd($request->all());
        //        dd($request['id_perfil'][0]);
        $this->validator($request->all())->validate();

        if( $request->id_perfil == User::PFL_SUPERVISOR){
            $user = new User();

            $user->tx_name             = $request->tx_name;
            $user->username            = $request->username;
            $user->id_perfil           = $request->id_perfil;
            // $user->id_theoretical_line = $request->id_theoretical_line;
            $user->nu_telephone        = $request->nu_telephone;
            $user->nu_cellphone        = $request->nu_cellphone;
            $user->tx_justify          = $request->tx_justify;
            $user->tx_email            = $request->tx_email;
            $user->password            = Hash::make($request->password);

            echo 232;
            $supervisor = $user->save();
            dd($supervisor);
        }
        echo 404;
        dd($request->all());

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('register')
            ->with(['registered' => 'Parabéns! Sua conta foi registrada com sucesso, a equipe de gestão do sistema irá avaliar suas credênciais.']);
    }
}
