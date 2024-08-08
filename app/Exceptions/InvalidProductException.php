<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidProductException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'data' => null,
            'msg' => 'Item not found.',
        ], Response::HTTP_NOT_FOUND);
    }
}
