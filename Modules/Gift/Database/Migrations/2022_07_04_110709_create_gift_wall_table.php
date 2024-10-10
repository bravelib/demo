<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftWallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_wall', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('uid')->default(0)->comment('用户id');
            $table->bigInteger('gift_id')->default(0)->comment('礼物id');
            $table->integer('gift_number')->default(0)->comment('礼物数量');
            $table->unique(['uid', 'gift_id']);
        });
        DB::statement("ALTER TABLE `gift_wall` comment '礼物墙'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_wall');
    }
}
