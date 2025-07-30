<?php

namespace App\Classes\Api\v1;

use Symfony\Component\HttpFoundation\Response;

/**
 * Clase encargada de manejar respuestas
 */
class ApiResponse
{
    /**
     * Genera una respuesta en formato json
     * @param bool $success Indica si la respuesta es de éxito
     * @param string|null $message Mensaje que se quiera retornar
     * @param mixed $data Información a retornar
     * @param mixed $code Código de respuesta
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function response(bool $success = false,  string|null $message = null, $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
