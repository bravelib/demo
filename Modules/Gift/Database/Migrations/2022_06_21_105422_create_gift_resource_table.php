<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_resource', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('')->comment('名称');
            $table->string('image', 500)->default('')->comment('缩略图');
            $table->string('type', 32)->default('')->comment('文件类型，svga|mp4');
            $table->string('file', 500)->default('')->comment('文件地址');
            $table->string('permanent_type', 32)->default('')->comment('常驻文件类型，svga|mp4');
            $table->string('permanent_file', 500)->default('')->comment('常驻文件地址');
            $table->string('sound_file', 500)->default('')->comment('音效文件地址');
            $table->tinyInteger('status')->default(0)->comment('状态，1封禁0激活');
        });
        DB::statement("ALTER TABLE `gift_resource` comment '礼物样式资源表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_resource');
    }
}
