<?php

namespace Application\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    public static function success(array $data, bool $success = true, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            'success' => $success,
            'data' => $data,
            'statusCode' => $statusCode,
        ], $statusCode);
    }

    public static function error(string $message, bool $success = false, int $statusCode = 400): JsonResponse
    {
        return new JsonResponse([
            'success' => $success,
            'error' => $message,
            'statusCode' => $statusCode,
        ], $statusCode);
    }
}
