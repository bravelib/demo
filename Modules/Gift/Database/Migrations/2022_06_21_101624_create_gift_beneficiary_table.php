<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_beneficiary', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('room_id')->default(0)->comment('所属房间id');
            $table->string('scene')->default('')->comment('刷礼物场景,如房间、小黑屋');
            $table->bigInteger('scene_id')->default(0)->comment('场景id');
            $table->bigInteger('bill_id')->default(0)->comment('收益对应账单id');
            $table->bigInteger('uid')->default(0)->comment('收益人用户id,平台是0');
            $table->string('identity')->default('')->comment('用户身份标识');
            $table->decimal('coin', 18, 8)->default(0.00)->comment('收益币数');
            $table->decimal('money', 18, 8)->default(0.00)->comment('收益金额');
            $table->index(['uid', 'scene', 'scene_id']);
            $table->index(['bill_id']);
            $table->index(['room_id', 'uid']);
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `gift_beneficiary` comment '全局刷礼物账单受益人记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_beneficiary');
    }
}
