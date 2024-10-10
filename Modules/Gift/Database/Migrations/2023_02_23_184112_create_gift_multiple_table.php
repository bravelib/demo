<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_multiple', function (Blueprint $table) {
            $table->id();
            $table->integer('name')->default(0)->comment('倍数');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `gift_multiple` comment '幸运礼物倍数'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_multiple');
    }
}
