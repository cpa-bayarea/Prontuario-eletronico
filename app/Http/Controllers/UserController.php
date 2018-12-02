<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
            if ($user->id_perfil == 1) {
                $user->id_perfil = 'Gestor';
            } elseif ($user->id_perfil == 2) {
                $user->id_perfil = 'Aluno';
            } elseif ($user->id_perfil == 3) {
                $user->id_perfil = 'Supervisor';
            } elseif ($user->id_perfil == 4) {
                $user->id_perfil = 'Secretária';
            } elseif ($user->id_perfil == 5) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user = User::find(Auth()->user()->id);
            $user->avatar = $request->avatar->getClientOriginalName();
            $user->save();
            $request->avatar->storeAs('imgs/avatars/', $request->avatar->getClientOriginalName());
        }

        $user = Auth()->user();
        return view('auth.profile', compact('user'));

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
}
