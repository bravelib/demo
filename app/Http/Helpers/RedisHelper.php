<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Redis;


class RedisHelper
{

    /*****************************************
     * list 操作命令
     *****************************************/


    /*****************************************
     * set 操作命令
     *****************************************/

    public static function sAdd($key, string $members)
    {
        return Redis::sadd($key, $members);
    }

    public static function sscan($baseKey, $it)
    {
        return Redis::SScan($baseKey, $it);
    }

    public static function srandmember($baseKey, $it)
    {
        return Redis::srandmember($baseKey, $it);
    }

    #增加
    public static function incrby($key, $value)
    {
        return Redis::INCRBY($key, $value);
    }

    #减少
    public static function decrby($key, $value)
    {
        return Redis::DECRBY($key, $value);
    }

    /*****************************************
     * string 操作命令
     *****************************************/

    public static function set($key, string $value, $expireResolution = null, $expireTTL = null, $flag = null)
    {
        return Redis::set($key, $value, $expireResolution, $expireTTL, $flag);
    }

    public static function get($key)
    {
        return Redis::get($key);
    }

    public static function setex($key, $expireTTL, $value)
    {
        return Redis::setex($key, $expireTTL, $value);
    }


    /*****************************************
     * key 操作命令
     *****************************************/

    public static function expire($key, int $seconds)
    {
        return Redis::EXPIRE($key, $seconds);
    }

    public static function del($key)
    {
        return Redis::del($key);
    }

    public static function exists($key)
    {
        return Redis::exists($key);
    }

    public static function rename($oldKey, $newKey)
    {
        return Redis::rename($oldKey, $newKey);
    }
}
