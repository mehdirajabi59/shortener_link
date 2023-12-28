<?php
function env($name, $default) {
    return getenv($name) ? getenv($name): $default;
}
return [
    'database' => [
        'db_host' => env('DB_HOST', '127.0.0.1'),
        'db_username' => env('DB_USERNAME', 'root'),
        'db_password' => env('DB_PASSWORD', '123456'),
        'db_name' => env('DB_NANE', 'shortener_link')
    ],
    'jwt' => [
        'secret_key' => env('SECRET_KEY', 'mehdi')
    ]
];