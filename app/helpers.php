<?php

/**
 * @param $message
 * @param $data
 * @param $meta
 * @param $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function apiResponse($message = null, $data = null, $meta = null, $statusCode = 200) :\Illuminate\Http\JsonResponse
{
    return response()->json([
        'message' => $message,
        'data' => $data,
        'meta' => $meta
    ], $statusCode);
}
