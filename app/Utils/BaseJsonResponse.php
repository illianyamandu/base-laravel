<?php

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Log;

class BaseJsonResponse
{
    public static string $successFild = 'success';

    public static string $errorFild = 'errors';

    public static string $dataFild = 'data';

    public static string $messageFild = 'message';

    public static string $codeFild = 'status_code';

    public static string $messages = 'messages';

    /**
     * @param string $message
     * @param array<string, mixed> $data
     * @param int $code
     * @param array<string|string, mixed> $messages
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($message, $data = [], $code = 200, $messages = [])
    {
        return self::response(true, $data, $message, $code, [], $messages);
    }

    /**
     * @param string|array<string> $message
     * @param int $code
     * @param array<string|string, mixed> $messages
     * @param array<string|string, mixed> $errors
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message, $code = 400, $errors = [], $messages = [])
    {
        if (is_array($message)) {
            if (empty($errors)) {
                $errors  = $message;
                $message = 'Ocorreu um erro';
            } else {
                $message = implode('; ', $message);
            }
        }

        return self::response(false, [], $message, $code, $errors, $messages);
    }

    /**
     * @param \Exception $e
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function exception(Exception $e)
    {
        Log::error($e);

        return self::error("Ocorreu um erro", 500, ["message" => $e->getMessage()]);
    }

    /**
     * @param bool $success
     * @param array<string, mixed> $data
     * @param string $message
     * @param int $code
     * @param array<string|string, mixed> $errors
     * @param array<string|string, mixed> $messages
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private static function response($success, $data, $message, $code, $errors, $messages)
    {
        return response()->json([
            self::$successFild => $success,
            self::$dataFild    => $data,
            self::$messageFild => $message,
            self::$errorFild   => $errors,
            self::$messages    => $messages,
            self::$codeFild    => $code,
        ], $code);
    }
}
