<?php

use Illuminate\Http\Request;

/**
 * @param \Illuminate\Http\Request $request
 * @param $limit
 * @param $offset
 * @param $defaultLimit
 * @return void
 */

function paginate(Request $request, &$limit, &$offset, $defaultLimit = 10)
{
    $limit = $request->has('limit') ? intval($request->get('limit')) : $defaultLimit;
    $page = $request->has('page') ? intval($request->get('page')) : 0;
    $offset = ($page - 1) * $limit;
}

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
