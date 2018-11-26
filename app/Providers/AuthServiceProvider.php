<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('Admin', function($user){
            return $user->id_perfil == '1';
        });

        $gate->define('Aluno', function($user){
            return $user->id_perfil == '2';
        });

        $gate->define('Supervisor', function($user){
            return $user->id_perfil == '3';
        });

        $gate->define('Secretaria', function($user){
            return $user->id_perfil == '4';
        });

        $gate->define('Terapeuta', function($user){
            return $user->id_perfil == '5';
        });
    }
}
