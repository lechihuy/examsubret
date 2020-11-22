<?php

namespace App\Exceptions;

use Exception;

class QueryException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => 'The query is invalid.',
                'code' => 500,
            ]
        ], 500);
    }
}
