<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftNumberGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_number_group', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_id')->default(0)->comment('对应礼物id');
            $table->integer('num')->default(1)->comment('礼物组数');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `gift_number_group` comment '幸运礼物组数'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_number_group');
    }
}
