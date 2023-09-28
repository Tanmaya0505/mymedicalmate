<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_bonuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',20);
            $table->bigInteger('ref_id',20)->nullable();
            $table->string('ref_code',255);
            $table->string('ref_coin_first',255)->nullable();
            $table->string('ref_coin_second',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referal_bonuses');
    }
}
