<?php
// config/cors.php

return [
    'paths' => ['api/*'], // Sólo rutas API
    'allowed_methods' => ['*'], // GET, POST, PUT, DELETE, etc.
    'allowed_origins' => [
        'http://localhost:5173/registro',
    'http://localhost:5173',
    'http://127.0.0.1:5173',
    'http://localhost:8000',
    'http://127.0.0.1:8000',
],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // false para JWT (no cookies)
];