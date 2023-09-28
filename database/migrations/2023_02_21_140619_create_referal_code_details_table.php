<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalCodeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_code_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('refer_id');
            $table->string('refer_code',255)->nullable();
            $table->bigInteger('reg_user_id',20)->nullable();
            $table->bigInteger('ref_user_id',20)->nullable();
            $table->string('amount',255)->nullable();
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
        Schema::dropIfExists('referal_code_details');
    }
}
