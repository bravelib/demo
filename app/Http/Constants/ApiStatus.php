<?php

namespace App\Http\Constants;

class ApiStatus
{
    const SUCCESS = [200, 'success'];
    /*------ 通用 status code ------*/
    const PARAM_ERROR                = [204, '参数错误'];
    const OPERATE_FAILED             = [206, '操作失败'];
    const PLATFORM_COIN_INSUFFICIENT = [241, '金币余额不足'];
}
