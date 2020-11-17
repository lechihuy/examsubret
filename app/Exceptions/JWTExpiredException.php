<?php

namespace App\Exceptions;

use Exception;

class JWTExpiredException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'Access token is expired.',
                'code' => 419,
                'type' => class_basename($this)
            ]
        ], 419);
    }
}
