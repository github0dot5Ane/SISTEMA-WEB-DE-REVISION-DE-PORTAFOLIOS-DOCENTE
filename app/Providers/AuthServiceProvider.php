<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Permiso para administrador
        Gate::define('es_administrador', function ($user) {
            return $user->es_administrador;
        });

        // Permiso para revisor
        Gate::define('es_revisor', function ($user) {
            return $user->es_revisor;
        });

        // Permiso para docente (ni administrador ni revisor)
        Gate::define('es_docente', function ($user) {
            return !$user->es_administrador && !$user->es_revisor;
        });
    }
}
