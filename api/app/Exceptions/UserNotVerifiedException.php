<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotVerifiedException extends Exception
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
            'message' => __("user.login.unverified"),
        ], 422);
    }
}
