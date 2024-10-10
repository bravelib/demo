<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('group_id')->default(0)->comment('分组id');
            $table->string('name')->default('')->comment('名称');
            $table->integer('resource_id')->default(0)->comment('静态资源id');
            $table->decimal('coin', 12, 2)->default(0.00)->comment('价格');
            $table->integer('sort')->default(0)->comment('排序，大数靠前');
            $table->string('gift_types')->default('')->comment('礼物类型 hall,week_star,blind_box,lover');
            $table->datetime('week_star_start_at')->nullable()->comment('作为周星礼物开始时间');
            $table->datetime('week_star_end_at')->nullable()->comment('作为周星礼物结束时间');
            $table->decimal('blind_box_coin_min', 12, 2)->default(0.00)->comment('盲盒礼物最小价值币数');
            $table->decimal('blind_box_coin_max', 12, 2)->default(0.00)->comment('盲盒礼物最大价值币数');
            $table->string('play_position')->default('')->comment('播放位置');
            $table->tinyInteger('status')->default(0)->comment('状态，1封禁0激活');
            $table->index(['group_id', 'status']);
        });
        DB::statement("ALTER TABLE `gift` comment '礼物列表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift');
    }
}
