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

        $gate->define('Gestor', function($user){
            return $user->tx_perfil == 'Gestor';
        });

        $gate->define('Aluno', function($user){
            return $user->tx_perfil == 'Aluno';
        });

        $gate->define('Supervisor', function($user){
            return $user->tx_perfil == 'Supervisor';
        });

        $gate->define('Secretaria', function($user){
            return $user->tx_perfil == 'Secretaria';
        });

        $gate->define('Terapeuta', function($user){
            return $user->tx_perfil == 'Terapeuta';
        });
    }
}
