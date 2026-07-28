<?php
/*
 * TAMBAHKAN potongan ini ke file bootstrap/app.php project Laravel 11 kamu,
 * di dalam method ->withMiddleware(function (Middleware $middleware) { ... })
 *
 * Contoh bootstrap/app.php setelah diedit:
 *
 * ->withMiddleware(function (Middleware $middleware) {
 *     $middleware->alias([
 *         'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
 *     ]);
 * })
 *
 * Jika pakai Laravel 10 ke bawah, cukup tambahkan baris berikut
 * ke array $routeMiddleware / $middlewareAliases di app/Http/Kernel.php:
 *
 * 'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
 */
