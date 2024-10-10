<?php

namespace App\Http\Helpers;

use App\Http\Constants\CacheKey;

class FunctionHelper
{

    public static function Factory(): FunctionHelper
    {
        return new self();
    }


    /**
     * 将上传文件路径转换为cdn域名地址
     * User: wml
     * DateTime: 2022/4/13 14:41
     * @param $path
     * @param string $disk
     * @return mixed|string
     */
    public static function getFileCdnUrl($path, string $disk = ''): mixed
    {
        if (empty($path)) {
            return '';
        }
        if (mb_substr($path, 0, 4) == 'http') {
            return $path;
        }
        $disk = empty($disk) ? config('filesystems.default') : $disk;
        return env('filesystem.cdn_url') . ($disk == 'public' ? '/storage/' : '/') . $path;
    }


    /**
     * 通用接口一级缓存方法
     * @date 2020-06-02 10:32
     * @param callable $callback
     * @param string $key
     * @param array $keyArr
     * @param int $time
     * @param bool $forceUpdate
     * @return mixed
     */
    public static function getKeyCacheData(callable $callback, string $key = '', array $keyArr = [], int $time = 7200, bool $forceUpdate = false): mixed
    {
        try {
            $keyArr = array_map(function ($item) {
                return is_array($item) ? null : $item;
            }, $keyArr);
            $key    = strtoupper(config('app.name') . ':' . CacheKey::CACHE_PREFIX . ':' . $key . ':' . (count($keyArr) != 0 ? implode(':', $keyArr) : 'filed'));
            $debug  = request()->input('debug');
            $data   = RedisHelper::get($key);
            if ($data == '+OK') {
                $data = null;
            }
            if ($data !== null && empty($debug) && !$forceUpdate) {
                return unserialize($data);
            } else {
                $res = call_user_func($callback);
                RedisHelper::setex($key, $time, serialize($res));
                RedisHelper::setex($key . '_cache_create_time', $time, date('Y-m-d H:i:s'));
                return $res;
            }
        } catch (\Throwable $e) {
            dp($key, $keyArr);
            dp($e->getMessage(), $e->getTraceAsString());
            return false;
        }
    }

    /**
     * 删除一级缓存
     * @date 2020-06-03 16:46
     * @param string $key
     * @param array $keyArr
     */
    public static function delCacheKey(string $key = '', array $keyArr = []): void
    {
        if (!empty($key)) {
            $keyArr = array_map(function ($item) {
                return is_array($item) ? null : $item;
            }, $keyArr);
            $key    = strtoupper(config('app.name') . ':' . CacheKey::CACHE_PREFIX . ':' . $key . ':' . (count($keyArr) != 0 ? implode(':', $keyArr) : 'filed'));
            RedisHelper::del($key);
        }
    }

    /**
     * 浮点型数字简化，将.00的取整
     * User: wangmaolin
     * DateTime: 2022/11/29 10:39
     * @param $val
     * @return mixed|string
     */
    public static function floatFormat($val): mixed
    {
        if (str_contains($val, '.')) {
            return rtrim(rtrim($val, '0'), '.');
        }
        return $val;
    }
}
