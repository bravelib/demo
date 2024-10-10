<?php
/**
 * 用户账单
 */

namespace Modules\Gift\Http\Repositories;

use JetBrains\PhpStorm\Pure;

class UserBillRepository
{
    #[Pure] public static function Factory(): UserBillRepository
    {
        return new self();
    }
    /**
     * 记录用户收入账单
     * @param $bill
     * @return int
     */
    public static function userBillIncome($bill): int
    {
        $bill['pm'] = 1;
        $bill['created_at'] = date('Y-m-d H:i:s');
        $bill_id = UserBill::query()->insertGetId($bill);
        return $bill_id;
    }


    /**
     * 记录用户支出账单
     * @param $bill
     * @return int
     */
    public static function userBillExpend($bill): int
    {
        $bill['pm'] = 2;
        $bill['created_at'] = date('Y-m-d H:i:s');
        $bill_id = UserBill::query()->insertGetId($bill);
        return $bill_id;
    }


}
