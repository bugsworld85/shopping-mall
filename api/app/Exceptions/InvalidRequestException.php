<?php

namespace App\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json([
            'message' => __("exception.only.json"),
        ], 400);
    }
}
