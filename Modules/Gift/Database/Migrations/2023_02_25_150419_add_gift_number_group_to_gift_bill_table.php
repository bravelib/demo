<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGiftNumberGroupToGiftBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_bill', function (Blueprint $table) {
            $table->integer('number_group')->default(1)->comment('礼物组数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_bill', function (Blueprint $table) {
            $table->dropColumn(['number_group']);
        });
    }
}
