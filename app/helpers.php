<?php
/**
 * 高频使用的辅助方法
 */

use App\Http\Constants\ApiStatus;

/**
 * 日志纪录
 * @param mixed ...$vars
 */
function dp(...$vars): void
{
    foreach ($vars as $v) {
        if ($v === PHP_EOL) {
            info('--------------------------------------------------------------------------------------');
        } else {
            logger(print_r($v, true));
        }
    }
}

function dpChannel($message, $channel = 'daily'): void
{
    if ($message === PHP_EOL) {
        \Illuminate\Support\Facades\Log::channel($channel)->info('--------------------------------------------------------------------------------------');
    } else {
        \Illuminate\Support\Facades\Log::channel($channel)->info(print_r($message, true));
    }
}

function responseError(array $status, $content = null, array $headers = ['Content-Type' => 'application/json'], $httpCode = 200): \Illuminate\Http\JsonResponse
{
    $status[1] = str_replace('SQL:', '', $status[1]);
    return responseWithStatus($status, $content, $headers, $httpCode);
}

function responseWithStatus(array $status, $content, array $headers = [], $httpCode = 200): \Illuminate\Http\JsonResponse
{
    $response = [
        "code" => (int)$status[0],
        "msg"  => $status[1]
    ];
    if (defined('LARAVEL_START')) {
        $response['time'] = round(microtime(true) - LARAVEL_START, 3);
    } else {
        $response['time'] = round(microtime(true) - request()->REQUEST_START_TIME, 3);
    }
    if (is_array($content) || is_object($content)) {
        $response['data'] = $content;
    }

    return response()->json($response, $httpCode, $headers);
}

function responseSuccess($content = null, array $headers = ['Content-Type' => 'application/json']): \Illuminate\Http\JsonResponse
{
    return responseWithStatus(ApiStatus::SUCCESS, $content, $headers);
}
