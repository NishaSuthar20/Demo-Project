<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Handle 404 errors (route not found)
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->view('errors.404', ['exception' => $exception], 404);
        }

        // Handle 500 errors (server error)
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $exception->getStatusCode() == 500) {
            return response()->view('errors.500', ['exception' => $exception], 500);
        }

        // Return default error page for other exceptions
        return parent::render($request, $exception);
    }
}
