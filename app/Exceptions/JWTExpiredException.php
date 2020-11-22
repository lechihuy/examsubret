<?php

namespace App\Exceptions;

use Exception;

class JWTExpiredException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'The access token is expired.',
                'code' => 419,
                'type' => class_basename($this)
            ]
        ], 419);
    }
}
