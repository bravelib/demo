<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdxSceneidSceneIspermanentGiftcoinCreatedatToGiftBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_bill', function (Blueprint $table) {
            $table->index(['scene', 'scene_id','is_permanent','gift_coin','created_at']);
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
            $table->dropIndex(['scene', 'scene_id','is_permanent','gift_coin','created_at']);
        });
    }
}
