<?php

namespace Stagem\ZfcAsn;

return [
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
        ],
    ],
    'social_networks' => [
        'facebook' => [
            'id' => '961382317354145',
            'secret' => 'b3a8576a9dd7ab7e0e632179215c27e6',
            'redirectUri' => 'http://www.colmind.perfectit.com.ua/visitor/registration',
            'fields' => 'id,first_name,last_name,email,gender,location',
            //'redirectUri' => 'http://colmind.dev/visitor/registration',
        ],
        'google' => [
            'clientId'      => '1081878659052-8jdjr1c7qjjb7qp49q3m6jqe9rts17hn.apps.googleusercontent.com',
            'clientSecret'  => 'TCiIPIIb1KpAGrSehJqsZKS5',
            'scope'         => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
            'redirectUri'   => 'http://www.colmind.perfectit.com.ua/visitor/registration',
            //'redirectUri' => 'http://colmind.dev/visitor/registration',

        ],
    ],
];