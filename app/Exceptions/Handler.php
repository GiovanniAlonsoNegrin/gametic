<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Router;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected function renderExceptionResponse($request, Throwable $e)
    {
        return $this->shouldReturnJson($request, $e)
                    ? $this->prepareJsonResponse($request, $e)
                    : $this->prepareResponse($request, $e);
    }

    protected function prepareResponse($request, Throwable $e)
    {
        if (! $this->isHttpException($e) && config('app.debug')) {
            return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e)->prepare($request);
        }

        if (! $this->isHttpException($e)) {
            $e = new HttpException(500, $e->getMessage(), $e);
        }

        return $this->toIlluminateResponse(
            $this->renderHttpException($e, $request->path()), $e
        )->prepare($request);
    }

    protected function renderHttpException(HttpExceptionInterface $e, string $path = '')
    {
        $this->registerErrorViewPaths();

        if ($view = $this->getHttpExceptionView($e, $path)) {
            return response()->view($view, [
                'errors' => new ViewErrorBag,
                'exception' => $e,
            ], $e->getStatusCode(), $e->getHeaders());
        }

        return $this->convertExceptionToResponse($e);
    }

    protected function getHttpExceptionView(HttpExceptionInterface $e, string $path = '')
    {
        if (preg_match('/admin/i', $path)) {
            $view = 'errors::admin-'.$e->getStatusCode();
        } else {
            $view = 'errors::'.$e->getStatusCode();
        }

        if (view()->exists($view)) {
            return $view;
        }

        $view = substr($view, 0, -2).'xx';

        if (view()->exists($view)) {
            return $view;
        }

        return null;
    }
}
