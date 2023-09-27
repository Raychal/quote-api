<?php

namespace App\Traits;

trait ResponseAPI
{
    /**
     * Core of response
     *
     * @param string        $message
     * @param array|object  $data
     * @param integer       $statusCode
     * @param boolean       $isSuccess
     */
    public function coreResponse($message, $data, $statusCode, $isSuccess = true)
    {
        // Check the param
        if (!$message) {
            return response()->json(['message' => 'Message is required'], 500);
        }

        if ($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'data' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     *
     * @param string        $message
     * @param array|object  $data
     * @param interger      $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     *
     * @param string        $message
     * @param integer       $statusCode
     */
    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}
