<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_bill', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('room_id')->default(0)->comment('所属房间id');
            $table->string('scene')->default('')->comment('刷礼物场景');
            $table->bigInteger('scene_id')->default(0)->comment('场景id,如房间、小黑屋');
            $table->bigInteger('uid')->default(0)->comment('刷礼物用户id');
            $table->bigInteger('to_uid')->default(0)->comment('接收礼物用户id');
            $table->bigInteger('gift_id')->default(0)->comment('礼物id');
            $table->string('gift_name')->default('')->comment('礼物名称');
            $table->integer('gift_number')->default(0)->comment('礼物数量');
            $table->decimal('gift_coin', 12, 2)->default(0.00)->comment('价值币数');
            $table->decimal('gift_money', 12, 2)->default(0.00)->comment('价值金额');
            $table->tinyInteger('is_permanent')->default(0)->comment('是否常驻，1是0否');
            $table->string('source')->default('gift')->comment('礼物来源');
            $table->index(['scene', 'scene_id']);
            $table->index(['room_id']);
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `gift_bill` comment '全局刷礼物账单记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vcr_room_bill');
    }
}
