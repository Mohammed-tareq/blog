<?php

use App\Http\Middleware\AdminActive;
use App\Http\Middleware\CheckEmailVerifyActiveApi;
use App\Http\Middleware\CheckNotificationRead;
use App\Http\Middleware\UserActive;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::middleware(['web'])->group(base_path('routes/admin.php'));
        },

    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('web', [CheckNotificationRead::class]);
//        $middleware->appendToGroup('api', [CheckNotificationRead::class]);
        $middleware->redirectUsersTo(function () {
            if (Auth::guard('admin')->check()) {
                return route('admin.home');
            }
        });
        $middleware->redirectGuestsTo(function () {
            if(!Auth::guard('admin')->check()){
                return route('admin.login.show');
            }
        });
        $middleware->alias([
            'user.active' => UserActive::class,
            'admin.active' => AdminActive::class,
            'verifyEmailUser' => CheckEmailVerifyActiveApi::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return apiResponse(404, 'Route not found');
            }
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return apiResponse(405, 'Method not allowed');
            }
        });

        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return apiResponse(500, 'Something went wrong');
            }
        });
    })->create();
