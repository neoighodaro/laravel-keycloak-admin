### A special thank you goes to Mnikoei (Original creator of laravel-keycloak-admin project.)



### Installation

```
composer require haizad/laravel-keycloak-admin
```

### Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="LaravelKeycloakAdmin\KeycloakAdminServiceProvider"
```

#### laravel-keycloak-admin



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




All api's are decleared in ```config\keycloakAdmin.php```
 
For every api just needs call api name as method on related service .

### Usages

Include the KeycloakAdmin inside your Laravel controller/API route
```
use LaravelKeycloakAdmin\Facades\KeycloakAdmin;
```

Example:
```php
KeycloakAdmin::serviceName()->apiName($parameters)


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


KeycloakAdmin::user()->update([

     'id' => 'user_id',

     'body' => [  // https://www.keycloak.org/docs-api/11.0/rest-api/index.html#_userrepresentation
             
             'username' => 'foo'
              
       ]

]);



KeycloakAdmin::role()->get([
      
     'id' => 'role_id'

]);
```

All other api calls are same as examples just needs to provide required parameters as described in https://www.keycloak.org/docs-api/11.0/rest-api/index.html
