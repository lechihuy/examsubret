<?php

namespace App\Exceptions;

use Exception;

class JWTInValidException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'Access token is invalid.',
                'code' => 403,
            ]
        ], 403);
    }
}
