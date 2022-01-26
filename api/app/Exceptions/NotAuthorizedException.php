<?php

namespace App\Exceptions;

use Exception;

class NotAuthorizedException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'message' => __("auth.authorize.failed"),
        ], 403);
    }
}
