<?php

use App\Http\Middleware\ApiKeyAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'api.key' => ApiKeyAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ModelNotFoundException|NotFoundHttpException $e, $request) {
            // Only return simple message if debug is disabled
            if (!config('app.debug')) {
                return response()->json([
                    'message' => 'Resource not found',
                ], 404);
            }

            // Return null to let Laravel fallback to the default error handler in debug mode
            return null;
        });
    })->create();
