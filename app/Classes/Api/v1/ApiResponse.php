<?php

namespace App\Classes\Api\v1;

use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    public static function response(bool $success = false,  string|null $message = null, $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
