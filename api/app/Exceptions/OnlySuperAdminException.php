<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlySuperAdminException extends Exception
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
            'message' => __("exception.only.super_admin"),
        ], 403);
    }
}
