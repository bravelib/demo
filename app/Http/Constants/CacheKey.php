<?php

namespace App\Http\Constants;


class CacheKey
{

    # 缓存前缀
    const CACHE_PREFIX = 'CACHE_PREFIX';

    # 用户信息
    const USER_INFO         = 'USER_INFO:V8:'; # 后拼接uid
    const GIFT_WALL_LIST_V2 = 'gift_wall_list:V2';

    const GIFT_IS_PERMANENT_V1 = 'gift_is_permanent:V1';

    const VCR_ROOM_MEMBER_LOG_V1 = "vcr_room_member_log:v1:%s:%s:%s"; //vcr_room_member房间和用户关系 缓存
}
