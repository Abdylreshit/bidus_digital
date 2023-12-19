<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException as BaseModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as BaseValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HttpResponse;
use Throwable;
use Illuminate\Auth\AuthenticationException;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|RedirectResponse|HttpResponse|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): HttpResponse|JsonResponse|Response|RedirectResponse
    {
        if ($this->shouldReturnJson($request, $e)) {
            if ($e instanceof BaseModelNotFoundException) {
                $exception = new ModelNotFoundException;

                return $exception->render();
            }

            if ($e instanceof BaseValidationException){
                $exception = new ValidationException($e->errors());

                return $exception->render();
            }
        }

        return parent::render($request, $e);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return mixed
     * @throws UnAuthenticatedException
     */
    protected function unauthenticated($request, AuthenticationException $exception): mixed
    {
        return $this->shouldReturnJson($request, $exception)
            ? throw new UnAuthenticatedException
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
