<?php
if (!function_exists('throwedError')) {
    function throwedError(\Throwable $th)
    {
        return response()->json([
            'message' =>  $th->getMessage(),
            'status' => false
        ], SERVER_ERROR);
    }
}

if (!function_exists('actionResponse')) {
    function actionResponse(bool $status, string $successMessage, ?string $errorMessage = CREATE_ERROR)
    {
        return response()->json([
            'message' => $status ? $successMessage : $errorMessage,
            'status' => $status
        ], SERVER_SUCCESS);
    }
}
