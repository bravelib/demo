<?php

namespace Modules\Gift\Http\Constants;


class CacheKey extends \App\Http\Constants\CacheKey
{
    # 用户最近一次送出的礼物信息
    const GIFT_USER_LATELY_GIVE = 'GIFT_USER_LATELY_GIVE:'; # 后拼接送出礼物的用户id


}
