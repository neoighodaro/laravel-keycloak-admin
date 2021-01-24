### This is a forked repository from https://github.com/Mnikoei/laravel-keycloak-admin

Original work credited to Mnikoei. 

### Alternative

Keycloak Admin library made by Scito. 
https://gitlab.com/scito-performance/keycloak-admin

--------

### Supports
<li>Laravel 8</li>
<li>Lumen 8</li>

### Installation

```
composer require haizad/laravel-keycloak-admin
```

### Copy the package config to your local config with the publish command:

#### Laravel only
```shell
php artisan vendor:publish --provider="LaravelKeycloakAdmin\KeycloakAdminServiceProvider"
```

#### Lumen only

Register the provider in your boostrap app file ```bootstrap/app.php```

Add the following line at that files. Please note that 
```$app->configure('keycloakAdmin');``` should be placed below 
```$app->register(\LaravelKeycloakAdmin\KeycloakAdminServiceProvider::class);```.

```php

//"Register Service Providers"  section
$app->register(\LaravelKeycloakAdmin\KeycloakAdminServiceProvider::class);
$app->configure('keycloakAdmin');

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;

```

For facades, uncomment ```$app->withFacades();``` in your boostrap app file ```bootstrap/app.php```

### Environment Setup

Add these environment variables to your .env :


```
KEYCLOAK_BASE_URL=http://keycloak-domain.example/auth

KEYCLOAK_REALM=                

KEYCLOAK_REALM_PUBLIC_KEY=     # realm settings -> keys 

KEYCLOAK_CLIENT_ID=            

KEYCLOAK_CLIENT_SECRET=        # clients -> your_client -> credentials 

KEYCLOAK_ADMIN_BASE_URL=${KEYCLOAK_BASE_URL}/admin/realms/${KEYCLOAK_REALM} 
```



#### Enable realm managment

Go to ```clients -> your_client -> Service Account``` then select realm-managment

from Client Roles list and assign realm-admin to client.



#### Available methods : 


Package has provided services as below:

* user
* role
* client
* clientRole
* addon


Available functions:

* Create User
* Get All User
* Query User

All API's are declared in ```config\keycloakAdmin.php```

### Usages

Include the KeycloakAdmin inside your Laravel controller/API route
```
use LaravelKeycloakAdmin\Facades\KeycloakAdmin;
```

Example:
```php
KeycloakAdmin::serviceName()->apiName($parameters)

//Create User Sample
//Refer https://www.keycloak.org/docs-api/11.0/rest-api/index.html#_userrepresentation
KeycloakAdmin::user()->create([
                'body' => [
                        'username' => 'foo',
                        'enabled' => true,
                        'emailVerified' => false,
                        'email' => 'foo@email.com',
                        'credentials' => [[
                            'type' => 'password',
                            'value' => 'foobar',
                            'temporary' => false
                        ]]
                  ]
]);

//Query User Sample
//Refer Query parameter on GET /{realm}/users https://www.keycloak.org/docs-api/11.0/rest-api/index.html
KeycloakAdmin::user()->find([
            'query' => [ 
                 'email' => 'foobar@example.com'
            ]
]);

//Get All User Sample
KeycloakAdmin::user()->all();

```

### Additional Methods 

#### Logout User session by user Id

```
KeycloakAdmin::addon()->logoutById([
     'id' => 'user_id'
])
```

#### Set Expiry Access Token

```
KeycloakAdmin::addon()->setAccessTokenExpiry([
     'body' => [
             'accessTokenLifespan' => 60
       ]
])

```

### To do list
 - [x] Lumen Support
 - [ ] Import users from LDAP

All other api calls are same as examples just needs to provide required parameters as described in https://www.keycloak.org/docs-api/11.0/rest-api/index.html
