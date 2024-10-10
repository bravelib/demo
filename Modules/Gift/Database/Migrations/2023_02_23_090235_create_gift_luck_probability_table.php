<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftLuckProbabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_luck_probability', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('gift_id')->default(0)->comment('对应幸运礼物id');
            $table->integer('gift_multiple_id')->default(0)->comment('对应爆出的倍数id');
            $table->decimal('probability')->default(0.00)->comment('概率，万分比');
            $table->tinyInteger('status')->default(0)->comment('状态，1显示0隐藏');
            $table->unique(['gift_id', 'gift_multiple_id']);
        });
        DB::statement("ALTER TABLE `gift_luck_probability` comment '幸运礼物倍数概率'");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_luck_probability');
    }
}
