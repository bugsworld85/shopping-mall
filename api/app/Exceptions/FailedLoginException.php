<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedLoginException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return (new JsonResource($request->only(['email'])))
            ->additional([
                'message' => __('user.login.failed')
            ])
            ->response()
            ->setStatusCode(422);
    }
}
