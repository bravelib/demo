<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_group', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('')->comment('名称');
            $table->integer('sort')->default(0)->comment('排序，大数靠前');
            $table->tinyInteger('is_permanent')->default(0)->comment('是否常驻，1是0否');
            $table->tinyInteger('status')->default(0)->comment('状态，1封禁0激活');
        });
        DB::statement("ALTER TABLE `gift_group` comment '礼物分组'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_group');
    }
}
