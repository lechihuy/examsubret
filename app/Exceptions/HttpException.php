<?php

namespace App\Exceptions;

use Exception;

class HttpException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'Not found.',
                'code' => 404,
            ]
        ], 404);
    }
}
