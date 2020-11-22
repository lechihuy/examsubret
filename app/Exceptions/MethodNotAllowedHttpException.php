<?php

namespace App\Exceptions;

use Exception;

class MethodNotAllowedHttpException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'The method is not suported.',
                'code' => 405,
            ]
        ], 405);
    }
}
