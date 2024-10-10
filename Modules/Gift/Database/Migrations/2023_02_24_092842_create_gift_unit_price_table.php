<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftUnitPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_unit_price', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_id')->default(0)->comment('对应礼物id');
            $table->decimal('coin', 18, 8)->default(0.00)->comment('组礼物单价');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `gift_unit_price` comment '幸运礼物单价(注意区分组礼物的价格和组礼物的单价)'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_unit_price');
    }
}
