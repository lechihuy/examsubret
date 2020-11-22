<?php

namespace App\Exceptions;

use Exception;

class JWTInValidException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'The access token is invalid.',
                'code' => 401,
            ]
        ], 401);
    }
}
