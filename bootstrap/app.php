<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(remove: [
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        ]);
        
        $middleware->web(append: [
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        ]);
        
        $middleware->validateCsrfTokens(except: [
            '/consultar',
        ]);
        
        // Adicionar headers de segurança
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
        
        // Proteção contra ataques XSS e outros
        $middleware->preventRequestsDuringMaintenance();
        
        // Rate limiting global
        $middleware->throttleApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
