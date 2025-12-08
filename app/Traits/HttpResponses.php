<?php

namespace App\Traits;


trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'  => 'Request was successful.',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function error($message, $code, $errors = null)
    {
        return response()->json([
            'status' => 'Error has occurred.',
            'message' => $message,
            'error_code' => $code,
            'errors' => $errors
        ], $code);
    }
}
