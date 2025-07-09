<?php

namespace App\Classes\Api\v1;

use App\Classes\Api\v1\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class ExceptionHandler
{

    public static function handle(Throwable $e, $request)
    {
        if ($request->expectsJson()) {
            $message = null;
            $code = 200;

            // 400 Bad Request
            if ($e instanceof BadRequestException) {
                $message = $e->getMessage();
                $code = Response::HTTP_BAD_REQUEST;
            }

            // 401 Unauthorized
            else if ($e instanceof AuthenticationException) {
                $message = $e->getMessage() ?? 'No está autenticado';
                $code = Response::HTTP_UNAUTHORIZED;
            }

            // 403 Forbidden
            else if ($e instanceof AuthorizationException) {
                $message = 'No está autorizado a realizar esta acción';
                $code = Response::HTTP_FORBIDDEN;
            }

            // 404 Not Found
            else if ($e instanceof ModelNotFoundException) {
                $message = $e->getMessage() ?? class_basename($e->getModel()) . ' no encontrado';
                $code = Response::HTTP_NOT_FOUND;
            }

            // 404 Not Found
            else if ($e instanceof NotFoundHttpException) {
                $message = 'No se encontró la ruta ingresada';
                $code = Response::HTTP_NOT_FOUND;
            }

            // 405 Method Not Allowed
            else if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                $message = 'Método no permitido';
                $code = Response::HTTP_METHOD_NOT_ALLOWED;
            }

            // 422 Unprocessable Entity
            else if ($e instanceof UnprocessableEntityHttpException) {
                $message = $e->getMessage();
                $code = Response::HTTP_UNPROCESSABLE_ENTITY;
            }

            // 500 Internal Server Error
            else {
                $message = $e->getMessage() ?? 'Hubo un error en el servidor';
                $code = $e->getCode() ?? Response::HTTP_INTERNAL_SERVER_ERROR;
            }

            return ApiResponse::response(
                false,
                $message,
                null,
                $code
            );
        }
    }
}
