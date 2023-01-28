<?php

namespace Modules\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    protected $service;

    public function ok(array $data = [])
    {
        return response()->json($data, Response::HTTP_OK);
    }

    public function accepted($data = []): JsonResponse
    {
        return response()->json($data, Response::HTTP_ACCEPTED);
    }

    public function created(array $data = []): JsonResponse
    {
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function successResponse(array $data, $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public function errorResponse(int $errorCode, string $message, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $data = array(
            'code' => $errorCode,
            'message' => $message,

        );
        return response()->json($data, $statusCode);
    }
}
