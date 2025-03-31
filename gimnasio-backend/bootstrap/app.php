<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\ApplicationBuilder;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function ($middleware) {
        // ✅ Elimina el middleware de Sanctum y configura CORS
        $middleware->append(HandleCors::class, [
            'allowed_origins' => ['http://localhost:4200'], // URL de Angular
            'allowed_methods' => ['*'],                     // Todos los métodos
            'allowed_headers' => ['*'],                     // Todos los headers
            'exposed_headers' => [],                        // Headers expuestos
            'max_age' => 0,                                  // Tiempo de cache
            'supports_credentials' => false                  // No necesario para JWT
        ]);
    })
    ->withExceptions(function ($exceptions) {
        //
    })->create();