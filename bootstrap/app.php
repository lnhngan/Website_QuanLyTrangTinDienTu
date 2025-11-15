<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    
    // PHẦN NÀY ĐÃ ĐƯỢC SỬA LẠI (KHÔNG CÒN "auth:")
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // PHẦN NÀY VẪN GIỮ NGUYÊN (ĐỂ SỬA LỖI AUTHENTICATE)
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
     // THÊM MỚI: PHÂN QUYỀN THEO ROLE
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();