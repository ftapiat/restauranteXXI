<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if (!$request->expectsJson()){
            return parent::render($request, $e);
        }

        return $this->makeApiResponse($request, $e);
    }

    private function makeApiResponse($request, Throwable $e): JsonResponse
    {
        $code = 500;
        $data = null;
        $message = $e->getMessage();

        switch (true){
            case $e instanceof NotFoundHttpException:
                $message = empty(!$e->getMessage()) ? $e->getMessage() : "Página no encontrada.";
                $code = 404;
                break;
            case $e instanceof AuthenticationException:
                $message = "Debe iniciar sesión";
                $code = 401;
                break;
            case $e instanceof UnauthorizedException:
                # La autenticación de Spatie retorna 403 cuando el usuario no ha iniciado sesión ni ttiene permisos,
                #  por lo que se mantendrá como 401 tal como se ha usado con el middleware "auth"
                if ($message === "User is not logged in."){
                    $code = 401;
                } else {
                    $message = "El usuario no tiene permisos suficientes.";
                    $code = $e->getStatusCode();
                }
                break;
            case $e instanceof HttpException:
                $code = $e->getStatusCode();
                break;
            case $e instanceof ValidationException:
                $code = 422;
                $data = ["errors" => $e->errors()];
                break;
            case $e instanceof ModelNotFoundException:
                $code = 404;
                $message = "No se encontraron resultados para el recurso.";
                break;
            default:
                if (config('app.debug') !== true){
                    $message = "Error en el servidor.";
                }
                break;
        }

        $responseData = [
            'message' => $message,
            'status' => 'Error',
        ];

        if (app()->environment('local') || app()->environment('testing')){
            $responseData['exceptionClass'] = get_class($e);
            $responseData['trace'] = explode("\n", $e->getTraceAsString());
        }

        $responseData['data'] = $data;

        return response()->json($responseData, $code);
    }
}
