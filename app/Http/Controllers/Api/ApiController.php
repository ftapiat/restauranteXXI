<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\NoReturn;

/**
 * Clase abstracta que representa códigos HTTP y respuestas JSON generales.
 */
abstract class ApiController extends Controller
{
    private const OK_STATUS = 200;
    private const CREATED_STATUS = 201;
    private const BAD_REQUEST_STATUS = 400;
    private const UNAUTHORIZED_STATUS = 401;
    private const FORBIDDEN_STATUS = 403;
    private const NOT_FOUND_STATUS = 404;
    private const GONE = 410;
    private const SERVER_ERROR = 500;
    private const SERVICE_UNAVAILABLE = 503;

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 200, indicando que la solicitud se
     * ha realizado correctamente.
     *
     * @param mixed $data El contenido a retornar.
     * @param string $msg Un mensaje descriptivo de la respuesta.
     * @return JsonResponse
     */
    public function ok(mixed $data = null, string $msg = "OK"): JsonResponse
    {
        return response()->json([
            'message' => $msg,
            'status' => 'OK',
            'data' => $data,
        ], self::OK_STATUS);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 201, indicando que un modelo se creó
     * correctamente.
     *
     * @param mixed $data El contenido a retornar.
     * @param string $msg Un mensaje descriptivo de la respuesta.
     * @return JsonResponse
     */
    public function created(mixed $data = null, string $msg = "Registro exitoso"): JsonResponse
    {
        return response()->json([
            'message' => $msg,
            'status' => 'OK',
            'data' => $data,
        ], self::CREATED_STATUS);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 400, indicando que la solicitud no se
     * pudo realizar correctamente.
     *
     * @param string|null $msg Un mensaje descriptivo de la respuesta.
     * @return void
     */
    #[NoReturn] public function badRequest(string $msg = null): void
    {
        abort(self::BAD_REQUEST_STATUS, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 401, indicando que el usuario no está
     * autorizado para realizar la solicitud.
     *
     * @param string|null $msg Un mensaje descriptivo de la respuesta.
     * @return void
     */
    #[NoReturn] public function unauthorized(string $msg = null): void
    {
        abort(self::UNAUTHORIZED_STATUS, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 403, indicando que el usuario no tiene
     * permisos para realizar la solicitud.
     *
     * @param string|null $msg Un mensaje descriptivo de la respuesta.
     * @return void
     */
    #[NoReturn] public function forbidden(string $msg = null): void
    {
        abort(self::FORBIDDEN_STATUS, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 404, indicando que no se encontró el
     * recurso solicitado.
     *
     * @param string|null $msg Un mensaje descriptivo de la respuesta.
     * @return void
     */
    #[NoReturn] public function notFound(string $msg = null): void
    {
        abort(self::NOT_FOUND_STATUS, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 410, indicando que el recurso solicitado
     * ya no está disponible.
     *
     * @param string|null $msg
     * @return void
     */
    #[NoReturn] public function gone(string $msg = null): void{
        abort(self::GONE, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 500, indicando que el servidor no pudo
     * realizar la solicitud.
     *
     * @param string|null $msg
     * @return void
     */
    #[NoReturn] public function serverError(string $msg = null): void{
        abort(self::SERVER_ERROR, $msg);
    }

    /**
     * Retorna una respuesta JSON con los datos entregados y código HTTP 503, indicando que el servidor no está
     * disponible por problemas de mantenimiento o configuración.
     *
     * @param string|null $msg
     * @return void
     */
    #[NoReturn] public function serviceUnavailable(string $msg = null): void
    {
        abort(self::SERVICE_UNAVAILABLE, $msg);
    }
}
