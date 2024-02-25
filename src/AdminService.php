<?php

namespace LaravelKeycloakAdmin;

use LaravelKeycloakAdmin\Auth\ClientAuthService;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;
use LaravelKeycloakAdmin\Services\Client;
use LaravelKeycloakAdmin\Services\ClientRole;
use LaravelKeycloakAdmin\Services\Role;
use LaravelKeycloakAdmin\Services\User;
use LaravelKeycloakAdmin\Services\Addon;

class AdminService
{
    protected $container = [];

    protected ClientAuthService $auth;

    function __construct(ClientAuthService $auth) 
    {
        $this->auth = $auth;
        $this->registerServices();
    }

    public function getService(string $service)
    {
          return new $this->container[$service]($this->auth , new HttpClient());
    }

    public function registerServices() : void
    {
        $this->container =[
           'User' => User::class,
           'Role' => Role::class,
           'Client' => Client::class,
           'ClientRole' => ClientRole::class,
           'Addon' => Addon::class
        ];
    }

    public function user()
    {
       return $this->getService('User');
    }

    public function role()
    {
        return $this->getService('Role');
    }

    public function client()
    {
        return $this->getService('Client');
    }

    public function clientRole()
    {
        return $this->getService('ClientRole');
    }

    public function addon()
    {
        return $this->getService('Addon');
    }
}
