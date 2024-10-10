<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftBlindBoxProbabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_blind_box_probability', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('gift_id')->default(0)->comment('对应礼物id');
            $table->decimal('probability')->default(0.00)->comment('概率，万分比');
            $table->tinyInteger('status')->default(0)->comment('状态，1显示0隐藏');
        });
        DB::statement("ALTER TABLE `gift_blind_box_probability` comment '盲盒礼物概率'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_blind_box_probability');
    }
}
