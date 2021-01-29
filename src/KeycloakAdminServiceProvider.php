<?php

namespace LaravelKeycloakAdmin;

use Illuminate\Support\ServiceProvider;
use LaravelKeycloakAdmin\AdminService;

class KeycloakAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {   
        $this->app->bind('KeycloakAdmin', function ($app) {
            return $app->make(AdminService::class);
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/keycloakAdmin.php' => base_path() . '/config/keycloakAdmin.php',
        ], 'KeycloakAdmin');
    }
}
