<?php

namespace Modules\Gift\Http\Controllers;

use App\Http\Constants\ApiStatus;
use App\Http\Helpers\RedisHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gift\Http\Repositories\GiftRepository;
use Modules\Gift\Models\Gift;
use Modules\Gift\Models\User;
use Throwable;

class GiftController extends Controller
{
    /**
     * 赠送幸运礼物(按组赠送礼物)
     * User:ytx
     * DateTime:2023/2/24 15:33
     */
    public function giveGroupGift(Request $request): JsonResponse
    {

        $uid          = $request->uid;
        $to_uid       = $request->input('to_uid', ''); # '1,2,3' 多用户(全麦)
        $to_uid       = array_filter(explode(',', $to_uid));
        $gift_id      = $request->input('gift_id', 0);
        $scene        = $request->input('scene', ''); # room|black|chat|help|bar_greet|bar_dating
        $scene_id     = (int)$request->input('scene_id', 0); # 房间id|小黑屋id,聊天会话id
        $number_group = (int)$request->input('number_group', 1);# 礼物组数，默认最小组数1组

        if (in_array($uid, $to_uid)) {
            return responseError([0, '不能送给自己']);
        }

        //防止高并发 礼物信息加入redis缓存 数据存在取redis 不存在取数据库在存redis
        $giftkey       = 'luckgift' . $gift_id;
        $GiveGiftRedis = RedisHelper::get($giftkey);
        if ($GiveGiftRedis) {
            $giftInfo = json_decode($GiveGiftRedis, true);
        } else {
            $giftInfo = Gift::query()->where(['id' => $gift_id, 'status' => 1])->with('unit_price')->first();
            if (empty($giftInfo)) {
                return responseError([0, '所选礼物不存在，无法赠送']);
            }
            RedisHelper::set($giftkey, json_encode($giftInfo));
        }

        # 礼物接收者人数
        $to_uid_num = count($to_uid);

        # 礼物单价（单价*倍数=返现的币数）
        $giftUnitCoin = $giftInfo['unit_price']['coin'];

        # 礼物所需总价值
        $giftTotalNeedCoin = bcmul($giftInfo['coin'], $number_group * $to_uid_num, 8);

        # 每个人收到的礼物价值
        $eachUserGiftCoin = bcmul($giftInfo['coin'], $number_group, 8);

        # 校验用户币余额是否充足
        $userCoinBalance = User::query()->where(['id' => $uid])->value('coin');
        if ($userCoinBalance < $giftTotalNeedCoin) {
            return responseError(ApiStatus::PLATFORM_COIN_INSUFFICIENT);
        }

        try {
            foreach ($to_uid as $v) {
                # 赠送礼物
                GiftRepository::Factory()->doGiveGroupGift($uid, $v, $giftInfo, $scene, $scene_id, $number_group, $eachUserGiftCoin, $giftUnitCoin);
            }
            return responseSuccess();
        } catch (Throwable $e) {
            dp('礼物赠送出错,结束任务');
            return responseError([0, $e->getMessage()]);
        }
    }
}
