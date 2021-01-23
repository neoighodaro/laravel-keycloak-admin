<?php

namespace LaravelKeycloakAdmin;

use LaravelKeycloakAdmin\AdminService;
use Illuminate\Support\ServiceProvider;

class KeycloakAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('KeycloakAdmin' , function ($app){
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
        //Added for Lumen.
        mkdir(base_path() . '/config', 0755, true);
        
        $this->publishes([
            __DIR__.'/Config/keycloakAdmin.php' => base_path() . '/config/keycloakAdmin.php'
        ] , 'KeycloakAdmin');
    }
}
