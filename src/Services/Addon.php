<?php

namespace LaravelKeycloakAdmin\Services;

use LaravelKeycloakAdmin\Auth\ClientAuthService;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Arr;

class Addon extends Service
{
    public function __construct(ClientAuthService $auth , ClientInterface $http)
    {
        parent::__construct($auth, $http);
        $this->api = config('keycloakAdmin.api.addon');
    }

    public function response($response)
    {
        if (!empty( $location = $response->getHeader('location') )){

            $url = current($location) ;

            return $this->get([
                'id' => substr( $url , strrpos( $url , '/') + 1 )
            ]);
        }

        return json_decode($response->getBody()->getContents() , true) ?: true ;
    }
}
