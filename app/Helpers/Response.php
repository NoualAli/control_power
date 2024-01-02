<?php
if (!function_exists('throwedError')) {
    function throwedError(\Throwable $th)
    {
        return response()->json([
            'message' => in_array(env('APP_ENV'), ['production', 'production-test']) ? DEFAULT_ERROR_MESSAGE : $th->getMessage(),
            'status' => false
        ], SERVER_ERROR);
    }
}

if (!function_exists('actionResponse')) {
    function actionResponse(bool $status, string $successMessage, ?string $errorMessage = DEFAULT_ERROR_MESSAGE, int $code = SERVER_SUCCESS)
    {
        return response()->json([
            'message' => $status ? $successMessage : $errorMessage,
            'status' => $status
        ], $code);
    }
}
